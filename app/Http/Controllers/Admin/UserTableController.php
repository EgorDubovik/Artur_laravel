<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\ProductTableField;


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

    public function store(Request $request){
    	$fields = null;
    	$is_writeable = null;
    	foreach ($request->fields as $key => $field) {
    		if(!is_null($field)){
    			$fields[] = $field;
    			$is_writeable[] = $request->is_writeable[$key];
    		}
    	}

    	dd($request->is_writeable);
    	$request->merge(['fields'=>$fields]);
    	$request->merge(['is_writeable'=>$is_writeable]);

    	$validator = $request->validate([
    		'user_id'=>'required',
    		'fields'=>'required'
    	],[
    		'user_id.required'=>'The user id is required',
    		'fields.required'=>'More fields needed',
    	]);

    	

    	// $new_table = Product::create([
    	// 	'user_id'=>$request->user_id
    	// ]);

    	// foreach ($request->fields as $key => $field) {
    	// 	ProductTableField::create([
    	// 		'table_id'=>$new_table->id,
    	// 		'title'=>$field,
    	// 		'is_writeable'=>$request->is_writeable[$key],
    	// 	]);
    	// }



    	return redirect('/admin/user/table/'.$request->user_id)->with('success','New table for user created successfull');
    }
}
