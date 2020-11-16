<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Payments;
class AdminController extends Controller
{
    
	public function addNewUser(Request $request){
		//dd($request);
		$event = false;
		$error = true;
		if(isset($request->event)){
			$event = true;
			if($request->event=="add_new_user"){
				$user = User::create([
					'first_name' => $request->first_name,
					'last_name'	=> $request->last_name,
					'email' => $request->email,
					'phone_number' => null,
					'password' => password_hash($request->password, PASSWORD_BCRYPT),
					'is_admin' => ($request->has("admin")) ? 1 : 0,
				]);
				if($user->save()){
					$error = false;
				}
				if(isset($request->amount)){
					$payment = Payments::create([
						'user_id'=>$user->id,
						'amount' => $request->amount,
						'status' => Payments::PENDING,
					]);

				}
			}
		}


		return view("admin.add_user")->with(['event'=>$event,'error'=>$error]);
	}

	public function listUsers(Request $request){
		
		$users = User::where("id","<>",Auth::user()->id)->orderBy("id",'desc')->get();
		
		return view("admin.users")->with(["users"=>$users]);
	}

}
