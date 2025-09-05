<?php

namespace App\Http\Front\Cart\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'package'=>$this->package->name,
            'quantity'=>$this->quantity,
            'price'=>($this->package->price * $this->quantity)
        ];
    }
}
