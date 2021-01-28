<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMerchant extends Model
{
    protected $table = 'jenis_merchant';
    
    public function merchant(){
        return $this->hasMany('App\Merchant', 'id_jenis_merchant');
    }
}
