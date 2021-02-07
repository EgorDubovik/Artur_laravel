<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserServices extends Model
{
    protected $table = "user_services";
    protected $fillable = [
    	'id_service',
    	'id_payment',
    	'count',
    ];

    function service(){
    	return $this->belongsTo('App\Service','id_service');
    }
}
