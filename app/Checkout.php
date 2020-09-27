<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable=[
        'user_id','order_id','alamat_pengiriman','kode_pos','totalPrice'
    ];

    public function orderItems()
    {
        return $this->hasMany(orderItems::class);
    }
}
