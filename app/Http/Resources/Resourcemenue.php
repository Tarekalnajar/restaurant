<?php

namespace App\Http\Resources;
use Carbon\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;

class Resourcemenue extends JsonResource
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
            'name'=>$this->name,
            'descraption'=>$this->descraption,
            'price'=>$this->price,
            'resturant_id'=>$this->resturant->name,
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d H-i-s'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('Y-m-d H-i-s')

        ];
    }
}
