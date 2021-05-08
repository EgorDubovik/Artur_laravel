<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTableLine extends Model
{
    use HasFactory;
    protected $table = 'product_table_lines';

    protected $fillable = [
    	'table_id',
    ];

    function cells(){
    	return $this->hasMany('App\ProductTableCell','line_id');
    }
}
