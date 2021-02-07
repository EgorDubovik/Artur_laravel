<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    //
    protected $table = "varification_code";
    protected $fillable = [
    	"user_email",
    	"code",
    ];
}
