<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Resourced_order;

class Resourceorder extends JsonResource
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
            'resturant_id'=>$this->user->name,
            'user_id'=>$this->rest->name,
            'time'=>$this->time,
            'date'=>$this->date,
            'titel_price'=>$this->titel_price,
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d H-i-s'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('Y-m-d H-i-s'),
        ];
    }
}
