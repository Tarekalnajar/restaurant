<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_order extends Model
{
    use HasFactory;

    protected $fillable =['menu_id',	'quantity'	,'total',	'order_id','price'	];

    public function menu()
    {
     return $this->belongsTo(menu::class);
    }
    public function order()
    {
     return $this->belongsTo(order::class);
    }
}
