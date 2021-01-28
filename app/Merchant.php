<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Merchant extends Authenticatable
{
    use Notifiable;

    protected $guard = 'merchant';
    protected $table = 'merchant';

    public function kategori_merchant(){
        return $this->belongsTo('App\KategoriMerchant', 'id_kategori_merchant');
    }

    public function jenis_merchant(){
        return $this->belongsTo('App\JenisMerchant', 'id_jenis_merchant');
    }

    public function produk(){
        return $this->hasMany('App\Produk', 'id_merchant');
    }

    public function produk_sort(){
        return $this->hasOne('App\Produk', 'id_merchant');
    }

    public function transaksi(){
        return $this->hasMany('App\Transaksi', 'id_merchant');
    }

    protected $fillable = [
        'nama_pemilik_merchant',
        'nama_merchant',
        'id_kategori_merchant',
        'id_jenis_merchant',
        'username',
        'email',
        'password',
        'no_hp_merchant',
        'alamat',
        'point_merchant'
    ];

}
