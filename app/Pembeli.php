<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembeli extends Authenticatable
{
    protected $guard = 'pembeli';

    protected $table = 'pembeli';

    public function kategori_pembeli(){
        return $this->belongsToMany('App\KategoriPembeli');
    }

    function transaksi(){
        return $this->hasMany('App\Transaksi', 'id_pembeli');
    }

    public function kupon_pembeli(){
        return $this->belongsToMany('App\KuponPembeli', 'id_pembeli');
    }

    protected $fillable = [
        'nama_pembeli',
        'username',
        'nomor_pekerja',
        'fungsi' ,
        'bagian' ,
        'id_kategori_pembeli',
        'email' ,
        'password',
        'no_hp_pembeli',
        'alamat',
    ];
}
