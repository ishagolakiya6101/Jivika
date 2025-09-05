<?php

namespace App\Http\Front\Order\Controllers;

use App\DataTables\OrderDataTable;
use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Payment\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Front\Order\Resources\OrderResource;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function orderList(Request $request)
    {
        $orders = Order::where('user_id', auth()->user()->id)->with('bookings')->get();
        $data = OrderResource::collection($orders);
        return response()->json(['success' => 'order list', 'orders' => $data]);
    }
    public function index(OrderDataTable $datatable)
    {
        return $datatable->render('_back.order.index');
    }
    public function cancelOrder(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = Order::find($request->order_id);
        if ($order->status !== 'cancelled') {
            $payment = Payment::find($order->payment_id);
            $paymentId = $payment->razorpay_payment_id;

            if ($order->payment_gateway === 'razorpay') {
                $refund = $refund = $api->refund->create([
                    'payment_id' => $paymentId,
                    'amount' => $request->amount,
                ]);

                if ($refund && isset($refund['id'])) {
                    $order->update(['status' => 'cancelled']);
                    $payment->update(['status' => 'refunded']);
                }
            }
            return response()->json('success', 'Order cancelled successfully.');
        }

        return response()->json('error', 'Order is already cancelled.');
    }
}
