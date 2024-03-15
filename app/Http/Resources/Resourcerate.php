<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Resourcerate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'commint'=>$this->commint,
            'rate'=>$this->rate,
            'resturant_id'=>$this->resturant->name,
            'user_id'=>$this->user->name
        ];
        }
}
