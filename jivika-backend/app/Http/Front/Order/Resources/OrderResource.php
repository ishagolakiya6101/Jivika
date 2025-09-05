<?php

namespace App\Http\Front\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_id'=>$this->order_id,
            'status'=>$this->status,
            'total_amount'=>$this->total_amount,
            'ordered_services'=>BookingDetailResource::collection($this->bookings)
        ];
    }
}
