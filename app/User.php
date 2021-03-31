<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //
    protected $table = "users";

    protected $fillable = [
        'phone_number',
        'password',
        'first_name',
        'last_name',
        'email',
        'company_name',
        'location',
        'confirmed',
        'is_admin',
        'created_at',
        'shops',
        'description',
    ];

    function payments(){
        return $this->hasMany('App\Payments')->orderBy("created_at","desc");
    }

    function is_admin(){
        return $this->is_admin;
    }
}
