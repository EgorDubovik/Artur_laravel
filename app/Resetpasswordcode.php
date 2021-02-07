<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resetpasswordcode extends Model
{
    //
    protected $table = "resetpaswordcodes";
    protected $fillable = [
    	'user_id',
    	'code',
    ];
}
