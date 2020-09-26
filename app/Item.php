<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'kategori_barang','nama_barang','jumlah_barang','harga_barang','foto_barang',
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
