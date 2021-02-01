<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';


    public function pembeli(){
        return $this->belongsTo('App\Pembeli', 'id_pembeli');
    }
    public function merchant(){
        return $this->belongsTo('App\Merchant', 'id_merchant');
    }
    public function produk(){
        return $this->belongsTo('App\Produk', 'id_produk');
        // return $this->belongsTo('App\Produk');
    }

    public function foto_produk(){
        return $this->hasOne('App\FotoProduk', 'id_produk', 'id_produk');
    }


    protected $fillable = [
        'kode_transaksi',
        'bukti_transfer',
        'bukti_pengiriman',
        'pesan',
        'status_transaksi',
        'total_produk',
        'total_transaksi',
        'id_produk',
        'id_pembeli',
        'id_merchant',
    ];
}
