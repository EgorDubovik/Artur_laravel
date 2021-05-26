<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\WorkTable;
use App\WorkTableField;
use App\WorkTableLine;
use App\WorkTableCell;
class WorkTableCell extends Model
{
    use HasFactory;
    protected $table = 'product_table_cell';

    protected $fillable = [
    	'line_id',
    	'field_id',
    	'title',
    ];

    function line(){
    	return $this->belongsTo(WorkTableLine::class);
    }

    function field(){
        return $this->belongsTo(WorkTableField::class);   
    }
}
