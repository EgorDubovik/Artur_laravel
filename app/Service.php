<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "list_service";

    protected $fillable = [
    	'title',
    	'id_prefix',
    	'price',
    	'id_service',
    ];

    function prefix(){
    	return $this->belongsTo('App\Prefix','id_prefix');
    }

    function pod_services(){
    	return $this->hasMany('App\Service','id_service');
    }

    function parent(){
    	return $this->hasOne('App\Service','id','id_service');
    }
}
