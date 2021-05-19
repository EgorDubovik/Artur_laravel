<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ProductTableLine;

class ProductTableCell extends Model
{
    use HasFactory;
    protected $table = 'product_table_cell';

    protected $fillable = [
    	'line_id',
    	'field_id',
    	'title',
    ];

    function line(){
    	return $this->belongsTo(ProductTableLine::class);
    }
}
