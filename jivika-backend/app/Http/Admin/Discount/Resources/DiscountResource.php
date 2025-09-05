<?php

namespace App\Http\Admin\Discount\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
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
            'code'=>$this->code,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date, 
            'value'=>$this->value, 
            'type'=>$this->type,
            'max_limit'=>$this->max_limit, 
            'max_users_limit'=>$this->max_users_limit
        ];
    }
}
