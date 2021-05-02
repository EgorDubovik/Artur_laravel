<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;


class UserTableController extends Controller
{
    public function view(Request $request,$user_id)
    {

    	$table = Product::where('user_id',$user_id)->first();
    	$user = User::find($user_id);
    	return view('admin.product_table_view')
    		->with([
    			'table'=>$table,
    			'user'=>$user
    		]);
    }

    public function createTableView(Request $request,$user_id)
    {
    	$user = User::find($user_id);

    	return view('admin.create_product_table_view')
    		->with([
    			'user'=>$user
    		]);
    }
}
