<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoProduk extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
