<?php

namespace App\Http\Admin\ServiceProvider\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->first_name.' '.$this->last_name,
            "email" => $this->email,
            "phonenumber" => $this->phonenumber,
            "uuid" => $this->uuid,
            "user_type" => $this->roles->first()->name,
            "description" => !empty($this->provider) ? $this->provider->description : "",
            "title" => !empty($this->provider) ? $this->provider->title : "",
            "services" => !empty($this->provider) ? $this->provider->services->pluck('slug') : [],
            "image" =>$this->profile != null ? asset('storage/image/user/'.$this->profile) : "https://i.pravatar.cc/300?u=".$this->uuid,
        ];
    }
}
