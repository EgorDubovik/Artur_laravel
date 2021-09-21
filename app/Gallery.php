<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "images";

    protected $fillable = [
    	'name',
    	'is_active',
    ];
}
