<?php

namespace App\Http\Admin\Payment\Controller;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Payment\Models\Payment;
use App\Http\Admin\Payment\Requests\OrderDetailRequest;
use App\Http\Admin\Payment\Requests\PaymentRequest;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Controllers\Controller;
use App\Http\Front\Cart\Models\Cart;
use App\Http\Front\Order\Models\OrderItem;
use App\Http\Front\Order\Resources\OrderResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Admin;
use App\Models\BookingTimeSlot;
use App\Models\Notification;
use Carbon\Carbon;
use Exception;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ResponseTrait;
    public function createOrder(PaymentRequest $request)
    {
        $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
        try {
            $user = auth()->user();
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $request->amount,
                'status' => 'pending',
                'order_id' => Str::random(10)
            ]);
            $items = Cart::where('user_id', $user->id)->with('package')->get();
            // dd($items);
            foreach ($items as $item) {
                $date = Carbon::parse(strtotime($request->booking_date))->format('Y-m-d');
                $startTime = $request->booking_time;
                list($hours, $minutes, $seconds) = explode(':', $startTime);
                $duration = (int)$item->package->duration;
                $newTime = Carbon::createFromTime($hours, $minutes, $seconds)->addMinutes($duration);
                $endTime = $newTime->format('H:i:s');
                $booking = Booking::create([
                    'order_id' => $order->id,
                    'package_id' => $item->package_id,
                    'quantity' => $item->quantity,
                    'price' => $item->package->price
                ]);
                BookingTimeSlot::create([
                    'booking_id' => $booking->id,
                    'date' => $date,
                    'start_time' => $startTime,
                    'end_time' =>$endTime
                ]);
                $item->delete();
            }
            $notification_body = "Order created. Your Order id is:" . $order->order_id;
            Notification::create([
                'from_id' => Admin::first()->id,
                'to_id' => $user->id,
                'title' => 'Order Created',
                'body' => $notification_body,
                'entity_type' => "Order",
                'entity_id' => $order->id
            ]);
            $order = $api->paymentLink->create(array(
                'amount' => (int)$request->amount * 100,
                'currency' => 'INR',
                'description' => 'For XYZ purpose',
                'expire_by' => Carbon::now()->addMinutes(20)->timestamp,
                'customer' => array(
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email, 'contact' => $user->phonenumber
                ),
                'notify' => array('sms' => true, 'email' => true),
                'reminder_enable' => true,
                'notes' => array('policy_name' => 'Jeevan Bima', 'order_id' => $order->order_id),
                'callback_url' => route('paymentCallback'),
                'callback_method' => 'get'
            ));
            return $this->successResponse('Payment url', ['payment_url' => $order->short_url]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function paymentCallback(Request $request)
    {
        $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $order = Order::where('order_id', $payment->notes->order_id)->first();
            $order->update(['status' => $payment->status == 'captured' ? 'success' : 'cancelled']);
            Payment::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'amount' =>  $order->amount,
                'razorpay_payment_id' => $payment->id,
                'status' => $payment->status == 'captured' ? 'success' : 'failed',
            ]);
            $bookings = Booking::where('order_id', $order->id)->get();
            foreach ($bookings as $booking) {
                $notification_body = "Booking is created. Your Order id for booking is:" . $order->order_id;
                $provider = ServiceProvider::inRandomOrder()->first();
                $booking->update(['service_provider_id' => $provider->id]);
                Notification::create([
                    'from_id' => Admin::first()->id,
                    'to_id' => $provider->id,
                    'title' => 'Booking Created',
                    'body' => $notification_body,
                    'entity_type' => "Booking",
                    'entity_id' => $booking->id
                ]);
            }
            // $data = [
            //     'status' => $payment->status,
            //     'amount' => $payment->amount,
            //     'currency' => $payment->currency,
            //     'payment_id' => $payment->id,
            //     'captured_at' => $payment->created_at,
            // ];
            // return $this->successResponse('Payment sucessful', $data);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function OrderDetail(OrderDetailRequest $request)
    {
        $order = Order::where(['order_id' => $request->order_id, 'user_id' => auth()->user()->id])->with(['payment', 'bookings'])->first();
        if (empty($order))
            return $this->errorResponse('Order Not Found', 404);
        $data = new OrderResource($order);
        return $this->successResponse('Order details', ['data' => $data]);
    }
}
