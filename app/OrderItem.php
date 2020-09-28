<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=[
        'order_id','item_id','price', 'quantity'
    ];

    public function item()
    {
        return $this->hasOne(Item::class,'id');
    }


    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

}
