<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $fillable = [							
        'name',
        'descraption',
        'price',
        'resturant_id',

       ];
       public function resturant()
       {
        return $this->belongsTo(resturant::class,'resturant_id');
       }

       public function detail_order()
       {
        return $this->hasMany(detail_order::class);
       }
 
}
