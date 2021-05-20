<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Product;
use App\ProductTableField;
use App\ProductTableLine;
use App\ProductTableCell;


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
				 if(!is_null($request->is_writeable) && in_array($key, $request->is_writeable))
					 $is_writeable[] = 1;
				else 
					 $is_writeable[] = 0;
		  	}
		}

		$request->merge(['fields'=>$fields]);
		$request->merge(['is_writeable'=>$is_writeable]);

		$validator = $request->validate([
			'user_id'=>'required',
			  'fields'=>'required'
		],[
			'user_id.required'=>'The user id is required',
			'fields.required'=>'More fields needed',
		]);



		$new_table = Product::create([
			'user_id'=>$request->user_id
		]);

		foreach ($request->fields as $key => $field)
		{
			ProductTableField::create([
				'table_id'=>$new_table->id,
				'title'=>$field,
				'is_writeable'=>$request->is_writeable[$key],
			]);
		}
		return redirect('/admin/user/table/'.$request->user_id)->with('success','New table for user created successfull');
	}

	public function addLine(Request $request,$table_id)
	{
		$product_table = Product::find($table_id);
		if($product_table)
		{
			$product_table_line = ProductTableLine::create([
				'table_id'=>$table_id,
			]);

			foreach ($product_table->fields as $key => $field)
			{
				$product_table_cell = ProductTableCell::create([
					'line_id' => $product_table_line->id,
					'field_id' => $field->id,
					'title' => '',
				]);
			}

			return response()->json(['status'=>true,'line_id'=>$product_table_line->id]);
		} else {
			return abort(404);
		}
	}

	public function editCell(Request $request){
		
		$product_table_line = ProductTableLine::find($request->line_id);

		if($product_table_line->table->user_id==Auth::user()->id || Auth::user()->is_admin){
			$product_table_cell = ProductTableCell::where([
				'line_id'=>$request->line_id,
				'field_id'=>$request->field_id,
			])->first();
			
			$product_table_cell->title = $request->title;
			$product_table_cell->save();	
			return response()->json(['status'=>true]);
		}

		return response()->json(['status'=>false,'messange'=>"permission denied"]);
	}

	public function removeLine(Request $request, $line_id)
	{
		$product_table_line = ProductTableLine::find($line_id);
		$product_table_line->delete();
		return back();
	}
}
