<?php

namespace App\Http\Testimonial\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            "name"=>$this->name,
            "title"=>$this->title,
            "words"=>$this->words,
            "author_image"=>$this->author_image != null ? asset('storage/image/testimonial/'.$this->author_image) : '',
        ];
    }
}
