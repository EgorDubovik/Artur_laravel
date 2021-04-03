<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Payments;
use App\Service;
use App\UserServices;
use Auth;

class PaymentController extends Controller 
{
	
	public function index(Request $request,$userId)
	{
		$user = User::find($userId);
		$services = Service::whereNull('id_service')->get();
		return view("admin.makepayment")->with(["user"=>$user,"services"=>$services]);
	}

	public function saveNewPayment(Request $request)
	{
		if(count($request->services)>0){
			$amount = 0;
			foreach ($request->services as $in => $ser) {
				
				$srv = Service::find($ser);
				if($srv)
					$amount += $srv->price*$request->count[$in];
			}

			$payment = Payments::create([
				'user_id'=>$request->user_id,
				'amount' => $amount,
				'status' => Payments::PENDING,
			]);

			foreach ($request->services as $in => $serv) {
				if(is_numeric($serv))
					UserServices::create([
						'id_service'=>$serv,
						'id_payment'=>$payment->id,
						'count'=>$request->count[$in],
					]);
			}
			return redirect()->back()->with('successful','Save saccessful');
		}
		else 
		{
			return redirect()->back()->with('error','No service found');
		}

	}

	public function removePayment(Request $request,$paymentId)
	{
		Payments::find($paymentId)->delete();
		UserServices::where('id_payment',$paymentId)->delete();
		return redirect()->back()->with('successful','Deleted successful');
	}
	
}