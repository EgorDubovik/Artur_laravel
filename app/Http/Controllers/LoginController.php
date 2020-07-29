<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    //
	use AuthenticatesUsers;

	protected $loginPath = '/login';

    public function login(Request $request){
    	return view('auth.login');
    }

    public function enterPhone(Request $request){
    	$user = User::where("phone_number",$request->phone_number)->first();
    	if($user){
    		$code = mt_rand(1111,9999);
    		$user->code = $code;
    		$user->save();
    		return view('auth.enterCode')->with(array("code"=>$code,"phone_number"=>$request->phone_number));
    	} else {
    		return back();
    	}
    }


    public function enterCode(Request $request){
    	/*Сделать временные смс коды*/
    	$user = User::where([
    						['phone_number',$request->phone_number],
    						['code',$request->code],
    						])->first();
    	if($user){
    		Auth::login($user);
    		return redirect('dashboard');
    	} else {
    		return back();
    	}
    }

    public function logOut(Request $request){
    	Auth::logout();
    	return redirect("login");
    }

    public function dashboard(Request $request){
    	return view("dashboard");
    	
    	
    }

    
}
