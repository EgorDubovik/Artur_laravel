<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Auth;

class PriceListController extends Controller
{
	public function pricelist(Request $request)
	{
		$services = Service::whereNull('id_service')->get();
		return view("admin.pricelist")->with(["services"=>$services]);
	}


	public function pricelistRemove(Request $request,$id)
	{
		Service::find($id)->delete();	
		$services = Service::whereNull('id_service')->get();
		return view("admin.pricelist")->with(["services"=>$services]);		
	}

}
