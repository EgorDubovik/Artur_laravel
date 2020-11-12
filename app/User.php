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
        'is_admin',
    ];
}
