<?php

namespace App\Http\Front\Booking\Controllers;

use App\DataTables\BookingDataTable;
use App\Http\Admin\Service\Models\ServicePackage;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Front\Order\Resources\BookingResource;
use App\Http\Front\Order\Resources\OrderResource;
use App\Http\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    use ResponseTrait;
    public function index(BookingDataTable $datatable)
    {
        return $datatable->render('_back.booking.index');
    }
    public function bookings(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('freelancer')) {
            $bookings = Booking::where('service_provider_id', $user->provider->id)->with('order', 'package', 'serviceProvider')->get();
            $data = BookingResource::collection($bookings);
            return $this->successResponse("Booking List", $data);
        } elseif ($user->hasRole('customer')) {
            $orders = $user->orders;
            $data = OrderResource::collection($orders);
            return $this->successResponse("Order List", $data);
        }
    }
    public function bookingDetails(Request $request)
    {
        $bookings = Booking::where('id', $request->id)->with(['order' => function ($order) {
            $order->with('user');
        }, 'package' => function ($package) {
            $package->with('service');
        }])->first();
        return response()->json($bookings);
    }
    public function timeSlot(Request $request)
    {
        $package = ServicePackage::find($request->package_id);
        $startTime = Carbon::createFromTime(9, 0, 0);
        $endTime = Carbon::createFromTime(19, 0, 0); 
        $duration = 30;
        $timeSlots = [];
        $currentSlot = $startTime->copy();
        while ($currentSlot < $endTime) {
            $timeSlots[] = $currentSlot->copy()->format('H:i A');
            $currentSlot->addMinutes($duration);
        }
        return $this->successResponse("Time Slots",$timeSlots);
    }
}
