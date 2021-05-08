<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTableCell extends Model
{
    use HasFactory;
    protected $table = 'product_table_cell';

    protected $fillable = [
    	'line_id',
    	'field_id',
    	'title',
    ];
}
