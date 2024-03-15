<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    use HasFactory;
    protected $fillable = ['commint',	'rate'	,'resturant_id'	,'user_id'];
    
    public function resturant()
    {
     return $this->belongsTo(resturant::class);
    }

    public function user()
    {
     return $this->belongsTo(User::class);
    }
}
