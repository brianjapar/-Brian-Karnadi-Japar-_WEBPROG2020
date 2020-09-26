<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'kategori_barang','nama_barang','jumlah_barang','harga_barang','foto_barang',
    ];


    public function orders(){
        return $this->belongsTo(Order::class,'cart_id');
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
}
