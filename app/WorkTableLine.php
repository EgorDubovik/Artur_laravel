<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\WorkTable;
class WorkTableLine extends Model
{
    use HasFactory;
    protected $table = 'product_table_lines';

    protected $fillable = [
    	'table_id',
    ];

    function cells(){
    	return $this->hasMany('App\WorkTableCell','line_id');
    }

    function table(){
    	return $this->belongsTo(WorkTable::class);
    }
}
