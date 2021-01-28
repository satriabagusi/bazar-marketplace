<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    protected $table = 'foto_produk';

    public function produk(){
        return $this->belongsTo('App\Produk');
    }

    public function foto_produk_sort(){
        return $this->belongsTo('App\Produk', 'id_produk');
    }

    protected $fillable = [
        'url_foto',
        'id_produk'
    ];
}
