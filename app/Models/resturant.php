<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resturant extends Model
{
    use HasFactory;

   protected $fillable = [
    'name',
    'location',
    'type',
    'phone',
    'reate'
   ];
   public function menu()
   {
    return $this->hasMany(menu::class);
   }
   public function order()
   {
    return $this->hasMany(order::class);
   }
   public function rate()
   {
    return $this->hasMany(rate::class);
   }


}
