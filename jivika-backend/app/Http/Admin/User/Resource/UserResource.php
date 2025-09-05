<?php

namespace App\Http\Admin\User\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserResource extends JsonResource
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
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            "email"=>$this->email,
            "phonenumber"=>$this->phonenumber,
            "uuid"=>$this->uuid,
            "user_type"=>$this->roles->first()->name,
            "description"=>!empty($this->provider) ? $this->provider->description : "",
            "title"=>!empty($this->provider) ? $this->provider->title : "",
            "services"=>!empty($this->provider) ? $this->provider->services->pluck('id') : [],
            "image"=>$this->profile != null ? (str_contains($this->profile, "https://") ? $this->profile : asset('storage/image/user/'.$this->profile)) : "https://i.pravatar.cc/300?u=".$this->uuid,
            "access_token"=>$this->token ?? ''
        ];
    }
    // C:\xampp\htdocs\admin-panel\public\assets\img\avatars\1.png
}
