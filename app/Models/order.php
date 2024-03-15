<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [	
        'resturant_id',
        'user_id',
        'time',
        'date',
        'titel_price',

       ];

       public function user()
       {
        return $this->belongsTo(User::class,'user_id');
       }

       public function rest()
       {
        return $this->belongsTo(resturant::class,'resturant_id');
       }
       public function detail_order()
       {
        return $this->hasMany(detail_order::class);
       }

}
