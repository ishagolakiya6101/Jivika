<?php

namespace App\Http\Admin\Service\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicePackageResource extends JsonResource
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
            "service_id"=>$this->service_id,
            "price"=>$this->price,
            "included"=>$this->included,
            "excluded"=>$this->excluded,
            "how_work"=>$this->how_work,
            "duration"=>$this->duration,
            "image"=>asset('storage/image/packages/'.$this->image),
            "service"=>!empty($this->service)? $this->service->name : '',
            "ratings"=>$this->rating
        ];
    }
}
