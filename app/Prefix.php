<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
	protected $table = 'list_prefix';

	protected $fillable = [
		'prefix'
	];
}
