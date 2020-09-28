<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
       'user_id', 'status', 'alamat', 'kode_pos', 'invoice_id'
    ];



    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(orderItem::class);
    }
}
