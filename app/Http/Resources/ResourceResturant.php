<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use App\Http\Resources\Resourcemenue;
use App\Http\Resources\Resourcerate;


use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResturant extends JsonResource
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
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d H-i-s'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('Y-m-d H-i-s'),            
            'location'=>$this->location,
            'type'=>$this->type,
            'phone'=>$this->phone,
            'reate'=>$this->reate,
            'menue'=>Resourcemenue::collection($this->whenLoaded('menu')),


        ];

    }
}
