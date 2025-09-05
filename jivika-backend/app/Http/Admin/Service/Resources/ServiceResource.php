<?php

namespace App\Http\Admin\Service\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            "id"=>$this->id,
            "secure_id"=>$this->secure_id,
            "name"=>$this->name,
            "slug"=>$this->slug,
            "description"=>$this->description,
            "category_slug"=>$this->category->slug,
            "price"=>$this->price,
            "offer_price"=>$this->offer_price,
            "image"=>(str_contains($this->image, "https://placehold.co/") ? $this->image : asset('storage/image/service/'.$this->image)) ?? "https://placehold.co/600x400?text=Not%20found",
            "category"=>!empty($this->category)? $this->category->name : '',
            "providers"=>$this->provider,
            "providers_count"=>$this->provider->count(),
            "reviews"=>$this->reviews->count(),
            "ratings"=> $this->reviews->avg('ratings') ?? 0
        ];
    }
}
