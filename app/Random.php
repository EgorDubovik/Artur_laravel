<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Random extends Model
{
    protected $table = 'random_link';

	protected $fillable = [
		'title',
		'chance',
		'count_use',
	];
}
