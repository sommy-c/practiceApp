<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
     'name',
     'user_id',
     'category',
     'price',
     'description',
    'image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }



}
