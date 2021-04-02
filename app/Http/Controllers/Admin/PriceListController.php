<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Auth;

class PriceListController extends Controller
{
	public function pricelist(Request $request)
	{
		$services = Service::whereNull('id_service')->get();
		return view("admin.pricelist")->with(["services"=>$services]);
	}


	public function remove(Request $request,$id)
	{
		Service::find($id)->delete();
		$services = Service::whereNull('id_service')->get();

		return redirect()->route('price.list');		
	}

	public function edit(Request $request){
		$service = Service::find($request->serviceId);
		$service->update($request->all());
		$service->save();

		return redirect()->route('price.list')->with('successful','Changes saved');
	}
}
