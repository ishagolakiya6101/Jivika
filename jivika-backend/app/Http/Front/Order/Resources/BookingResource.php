<?php

namespace App\Http\Front\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            // 'package_id','order_id','quantity','service_provider_id','price','status'
            'id'=>$this->id,
            'quantity'=>$this->quantity,
            'order_id'=>$this->order_id,
            'price'=>$this->price,
            'status'=>$this->status,
            'package_id'=>$this->package_id,
            'package'=>$this->package,
            'service'=>$this->package->service,
            'service_provider_id'=>$this->service_provider_id,
            'booking_date'=>$this->created_at->toDateString()
            // 'service_provider'=>$this->serviceProvider,
            // 'address'=>$this->order->user->address
        ];
    }
}
