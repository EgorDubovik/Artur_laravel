<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\VerificationCode;
use Auth;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
                    ["email",$request->email],
                ])->first();
                if($user){
                    if(Hash::check($request->password,$user->password)){
                        $rem = ($request->remember_me) ? true : false;
                        Auth::login($user,$rem);
                        return redirect('dashboard');
                    } else {
                        return redirect("login");    
                    }
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

    public function signup(Request $request){

        if(isset($request->event)){

            if($request->event=="signup"){
                $messages = [
                    'same' => 'The passwords did not match',
                    'first_name.required' => 'The First name field is required.',
                    'last_name.required' => 'The Last name field is required.',
                    'pass1.required' => 'The Password field is required.',
                    'pass2.required' => 'The Confirm Password field is required.',
                ];
                $input = $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'pass1' => 'required',
                    'pass2'=> 'required|same:pass1',
                ],$messages);

                // $user = User::create([
                //     "first_name"=>$request->first_name,
                //     "last_name"=>$request->last_name,
                //     "email"=>$request->email,
                //     "confirmed"=>0,
                //     'password' => password_hash($request->pass1, PASSWORD_BCRYPT),
                //     'is_admin' => 0,
                // ]);

                if(true){
                    // Проверить на наличие по времени
                    $code = mt_rand(1000, 9999);
                    VerificationCode::create([
                        "user_email"=>$request->email,
                        "code"=>$code,
                    ]);    
                    return redirect("/code")->with(["email"=>$request->email,"code"=>$code]);
                } else {
                    return view('auth.signup')->withError("Something went wrong");
                }

            }
        }
        return view('auth.signup');
    }

    public function enterCode(Request $request){
        if(null!==Session::get("email"))
            return view("auth.enterCode")->with(["email"=>Session::get("email"),"code"=>Session::get("code")]);
        else
            return redirect("/signup");
    }
    
}
