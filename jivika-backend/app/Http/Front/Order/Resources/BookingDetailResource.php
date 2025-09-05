<?php

namespace App\Http\Front\Order\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'quantity'=>$this->quantity,
            'order_id'=>$this->order_id,
            'price'=>$this->price,
            'status'=>$this->status,
            'package_id'=>$this->package_id,
            'package'=>$this->package,
            'service'=>$this->package->service,
            'service_provider_id'=>$this->service_provider_id,
            'service_provider'=>$this->serviceProvider,
            'address'=>$this->order->user->address,
            'customer'=>$this->order->user,
            'booking_date'=>$this->created_at->toDateString()
        ];
    }
}
