<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'kategori_barang','nama_barang','jumlah_barang','harga_barang','foto_barang',
    ];


    public function orderItem(){
        return $this->belongsTo(OrderItem::class,'order_item_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable')->whereNull('parent_id');
    }
}
