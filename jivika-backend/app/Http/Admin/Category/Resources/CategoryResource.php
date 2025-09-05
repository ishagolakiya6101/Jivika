<?php

namespace App\Http\Admin\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "parent_id"=>$this->parent_id,
            "image"=>str_contains($this->image, "https://placehold.co/") ? $this->image : asset('storage/image/category/'.$this->image),
            "parent_category"=>!empty($this->category)? $this->category->name : ''
        ];
    }
}
