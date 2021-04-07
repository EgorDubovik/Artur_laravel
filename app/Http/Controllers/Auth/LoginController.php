<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\VerificationCode;
use App\Resetpasswordcode;
use Auth;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use EmailHelper;

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
                    ["confirmed",1],
                ])->first();
                if($user){
                    if(Hash::check($request->password,$user->password)){
                        $rem = ($request->remember_me) ? true : false;
                        Auth::login($user,$rem);
                        return redirect('dashboard');
                    } 
                }
            }
        }

        return redirect("login")->withInput();
    }

    

    public function logOut(Request $request){
    	Auth::logout();
    	return redirect("login");
    }

    public function signup(Request $request){

        if(isset($request->event)){

            if($request->event=="signup"){
                if(isset($request->email)){
                    $userCheck = User::where([
                        ["email",$request->email],
                        ["confirmed",0],
                    ])->first();
                    if($userCheck){
                        $userCheck->delete();
                    }
                }

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

                $user = User::create([
                    "first_name"=>$request->first_name,
                    "last_name"=>$request->last_name,
                    "email"=>$request->email,
                    "confirmed"=>0,
                    'password' => password_hash($request->pass1, PASSWORD_BCRYPT),
                    'is_admin' => 0,
                ]);

                if(true){
                    // Проверить на наличие по времени
                    
                    $code = $this->createAndSendCode($request->email);

                    return redirect("/code")->with(["email"=>$request->email]);
                } else {
                    return view('auth.signup')->withError("Something went wrong");
                }

            }
        }
        return view('auth.signup');
    }

    private function createAndSendCode($email){
        $code = mt_rand(1000, 9999);
        $flushCodes = VerificationCode::where("user_email",$email)->get();
        foreach ($flushCodes as $fcode) {
            $fcode->delete();
        }
        VerificationCode::create([
            "user_email"=>$email,
            "code"=>$code,
        ]);   

        // send code 
        return EmailHelper::sendVerificationCode($email,$code);
        
    }

    public function enterCode(Request $request){
        if(isset($request->code)){
            $user = User::where(["email"=>$request->email])->first();
            $dbcode = VerificationCode::where("user_email",$request->email)->first();
            if($dbcode->code==$request->code){
                $user->confirmed = 1;
                $user->save();
                $dbcode->delete();
                Auth::login($user);
                return redirect('dashboard');
            } else {
                return view("auth.enterCode")->with(["email"=>$request->email]);    
            }
        } else {
            //if(null!==Session::get("email"))
            return view("auth.enterCode")->with(["email"=>Session::get("email")]);
            // else
            //     return redirect("/signup");    
        }
    }

    public function resendcode(Request $request){

        if(isset($request->email)){
            $this->createAndSendCode($request->email);
            return redirect("/code")->with(["email"=>$request->email]);
        } else {
            return redirect("/signup");   
        }

    }

    public function forgotpassword(Request $request){
        
        return view("auth.forgotpassword");
    }

    public function sendlink(Request $request){
        $user = User::where(["email"=>$request->email])->first();
        if($user){
            // make secrert link
            $code = Str::random(52);
            $link = "http://warhouse.loc/resetpass/".$code;

            Resetpasswordcode::updateOrCreate(
                ["user_id"=>$user->id],
                ["code"=>$code]
            );
            // send email
            return redirect()->route('forgotpassword')->with(['success'=>'success','link'=>$link]);
        } else {
            return redirect()->route('forgotpassword')->with(['error'=>'Something went wrong, please try again']);
        }

    }
    
    public function restpass(Request $request,$code)
    {
        $issetEvent = false;
        $error = true;

        $restcode = Resetpasswordcode::where(["code"=>$code])->first();
        if($request->has("event")){
            $issetEvent = true;
            if($request->event=="enternewpass"){
                if($restcode){
                    $pass1 = $request->pass1;
                    $pass2 = $request->pass2;
                    if($pass1==$pass2){
                        if(strlen($pass1)>=8){
                            $user = User::find($restcode->user_id);
                            $user->password = password_hash($pass1, PASSWORD_BCRYPT);
                            $user->save();
                            $restcode->delete();
                            $error = false;
                        }
                    }
                }
            }
        }

        if($restcode){

            return view("auth.enternewpassword")->with(["email"=>$restcode->user_id,"code"=>$code,"issetEvent"=>$issetEvent,"error"=>$error]);
        } else {
            return view("auth.resetpassword")->with(["issetEvent"=>false,"error"=>false,"link"=>""]);
        }
    }
}
