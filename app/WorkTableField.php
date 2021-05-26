<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTableField extends Model
{
    use HasFactory;
    protected $table = 'product_table_field';

    protected $fillable = [
    	'table_id',
    	'title',
    	'is_writeable',
    ];


}
