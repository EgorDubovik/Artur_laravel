<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

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
			}
		}
		return view("admin.add_user")->with(['event'=>$event,'error'=>$error]);
	}

	public function listUsers(Request $request){
		$user = User::find(Auth::id());
		return view("admin.users");
	}

}
