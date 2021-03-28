<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    //
    protected $table = "payments";
    public const PENDING = 'PENDING';
    public const PAID = 'PAID';
    protected $fillable = [
    	'amount',
    	'status',
    	'user_id',
    	'updated_at',
    ];

    function serviceParents(){
        return $this->hasMany('App\UserServices','id_payment'); //wherePivotIn('',[])
    }

    function userServices(){
        return $this->hasMany('App\UserServices','id_payment');
    }
}
