<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKuponPembeli extends Model
{
    protected $table = 'jenis_kupon_pembeli';

    public function kupon_pembeli(){
        return $this->hasMany('App\KuponPembeli', 'id_jenis_kupon');
    }

    protected $fillable = [
        'deskripsi',
        'poin',
    ];
}
