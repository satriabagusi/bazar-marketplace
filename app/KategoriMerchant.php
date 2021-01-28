<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriMerchant extends Model
{
    protected $table = 'kategori_merchant';

    public function merchant(){
        return $this->hasMany('App\Merchant', 'id_kategori_merchant');
    }
}
