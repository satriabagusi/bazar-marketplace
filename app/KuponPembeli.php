<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KuponPembeli extends Model
{
    protected $table = 'kupon_pembeli';

    public function jenis_kupon_pembeli(){
        return $this->belongsTo('App\JenisKuponPembeli', 'id_jenis_kupon');
    }

    public function pembeli(){
        return $this->hasMany('App\Pembeli', 'id_pembeli');
    }

    protected $fillable = [
        'kode_kupon',
        'id_pembeli',
        'id_jenis_kupon',
    ];
}
