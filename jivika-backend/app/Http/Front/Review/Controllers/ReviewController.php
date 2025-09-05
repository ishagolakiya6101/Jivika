<?php

namespace App\Http\Front\Review\Controllers;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Service\Models\ServicePackage;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Front\Order\Models\OrderItem;
use App\Http\Front\Review\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function list(Request $request)
    {
        $reviews= Review::where('service_id',$request->service_id)->groupBy('service_id')->get();
        return response()->json(['success'=>'Review List','reviews'=>$reviews]);
    }
    public function store(Request $request)
    {
        if($request->hasFile('image') && $request->file('image') != null){
            $name=$request->file('image')->getClientOriginalName();  
            $path = "public/image/review/".$name;
            Storage::put($path, file_get_contents($request->file('image')));  
        }
        $package = ServicePackage::where('slug',$request->package)->first();
        $order = Order::where('order_id',$request->order_id)->first();
        $booking = Booking::where(['order_id'=>$order->id,'package_id'=>$package->id])->first();
        Review::create([
            'ratings'=>$request->ratings,
            'review_text'=>$request->review_text,
            'service_id'=>$package->service_id,
            'user_id'=>auth()->user()->id, 
            'image'=>$name ?? '',
            'booking_id'=>$booking->id,
            'service_provider_id'=>$booking->service_provider_id
        ]);
        return response()->json(['success'=>'Review Added successfully']);
    }
}
