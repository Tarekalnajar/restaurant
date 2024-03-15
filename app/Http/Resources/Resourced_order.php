<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class Resourced_order extends JsonResource
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
            'menu_id'=>$this->menu->name,	
            'quantity'=>$this->quantity,
            'total'=>$this->total,
            'order_id'=>$this->order->status,
            'price'=>$this->price,
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d H-i-s'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('Y-m-d H-i-s'),
        ];

    }
}
