<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
       'user_id','status'
    ];


    public function items()
    {
        return $this->hasMany(Items::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
