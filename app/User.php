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
        'pass',
        'first_name',
        'last_name',
        'company_name',
        'location',
    ];
}
