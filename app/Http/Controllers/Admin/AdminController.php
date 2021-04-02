<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Payments;
use App\Service;
use App\Prefix;
use App\UserServices;
use Auth;



class AdminController extends Controller
{

	// Навести порядок
	public function makePayment(Request $request,$id){
		$user = User::find($id);
		$is_event = false;
		$event_error = false;
		if(isset($request->event)){
			if($request->event=="new_payment"){
				if(count($request->service)>0){
					$amount = 0;
					foreach ($request->service as $in => $ser) {
						
						$srv = Service::find($ser);
						if($srv)
							$amount += $srv->price*$request->count[$in];
					}
					
					$payment = Payments::create([
						'user_id'=>$request->user_id,
						'amount' => $amount,
						'status' => Payments::PENDING,
					]);

					foreach ($request->service as $in => $serv) {
						if(is_numeric($serv))
							UserServices::create([
								'id_service'=>$serv,
								'id_payment'=>$payment->id,
								'count'=>$request->count[$in],
							]);
					}

					$is_event = true;
				}
			}
		}

		$services = Service::whereNull('id_service')->get();
		return view("admin.makepayment")->with(["user"=>$user,"services"=>$services,"is_event"=>$is_event]);
	}

	public function removePayment(Request $request,$user_id,$payment_id)
	{
		$payment = Payments::find($payment_id);
		foreach ($payment->userServices as $service) {
			$service->delete();
		}
		$payment->delete();
		return redirect("admin/user/".$user_id);
	}

}
