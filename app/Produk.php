<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    public function merchant(){
        return $this->belongsToMany('App\Merchant');
    }

    public function foto_produk(){
        return $this->hasMany('App\FotoProduk', 'id_produk');
    }

    public function merchant_sort(){
        return $this->belongsTo('App\Merchant', 'id_merchant');
    }

    public function foto_produk_sort(){
        return $this->hasOne('App\FotoProduk', 'id_produk');
    }

    public function kategori_produk(){
        return $this->belongsTo('App\KategoriProduk', 'id_kategori');
    }

    public function transaksi(){
        return $this->hasMany('App\Transaksi', 'id_produk');
    }

    protected $fillable = [
        'nama_produk',
        'stock',
        'harga',
        'deskripsi',
        'id_jenis_merchant',
        'id_merchant'
    ];

}
