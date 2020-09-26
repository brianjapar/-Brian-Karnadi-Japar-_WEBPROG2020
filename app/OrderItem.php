<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=[
        'order_id','item_id','price'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
