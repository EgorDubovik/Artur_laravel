<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\WorkTable;
use App\WorkTableField;
use App\WorkTableLine;
use App\WorkTableCell;

class UserTableController extends Controller
{
    public function view(Request $request)
    {	

    	$table = WorkTable::where("user_id",Auth::user()->id)->first();

    	return view('user-table')->with(['table'=>$table]);
    }
}
