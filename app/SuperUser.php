<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperUser extends Authenticatable
{
    protected $guard = 'superuser';

    protected $table = 'superuser';

    protected $fillable =[
        'nama',
        'email',
        'username',
        'no_hp_superuser',
        'password'
    ];

}
