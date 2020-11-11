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
        if(!Auth::check()){
    	   return view('auth.login');
        } else {
            return redirect('dashboard');
        }
    }


    public function actionLogin(Request $request){
        if(isset($request->event)){
            if($request->event == "login"){
                $user = User::where([
                    ["phone_number",$request->phone_number],
                    ["password",$request->password]
                ])->first();
                if($user){
                    Auth::login($user);
                    return redirect('dashboard');
                } else {
                    return redirect("login")->with(["error"=>true,"code"=>2]);                    
                }
            }
        }

        return redirect("login");
    }

    

    public function logOut(Request $request){
    	Auth::logout();
    	return redirect("login");
    }
    
}
