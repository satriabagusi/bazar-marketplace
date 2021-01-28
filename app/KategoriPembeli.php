<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPembeli extends Model
{
    protected $table = 'kategori_pembeli';
    
    public function pembeli(){
        return $this->hasMany('App\Pembeli', 'id_kategori_pembeli');
    }
}
