<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTable extends Model
{
    use HasFactory;

    protected $table = 'product_table';

    protected $fillable = [
    	'user_id'
    ];


    function fields(){
    	return $this->hasMany('App\WorkTableField','table_id');
    }

    function lines(){
    	return $this->hasMany('App\WorkTableLine','table_id');
    }
}
