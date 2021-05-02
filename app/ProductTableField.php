<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTableField extends Model
{
    use HasFactory;
    protected $table = 'product_table';

    protected $fillable = [
    	'table_id',
    	'title'
    ];


}
