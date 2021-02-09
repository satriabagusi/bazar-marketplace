<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KuponMerchant extends Model
{
    protected $table = 'kupon_merchant';

    public function merchant(){
        return $this->hasMany('App\Merchant', 'id_merchant');
    }

    protected $fillable = [
        'kode_voucher',
        'id_merchant',
    ];
}
