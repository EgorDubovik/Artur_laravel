<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Product;
use App\ProductTableField;
use App\ProductTableLine;
use App\ProductTableCell;

class UserTableController extends Controller
{
    public function view(Request $request)
    {	

    	$table = Product::where("user_id",Auth::user()->id)->first();

    	return view('user-table')->with(['table'=>$table]);
    }
}
