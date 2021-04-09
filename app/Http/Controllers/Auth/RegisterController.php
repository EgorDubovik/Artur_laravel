<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\VerificationCode;
use EmailHelper;

class RegisterController extends Controller
{

    public function view(){
        return view('auth.signup');
    }

    public function create(Request $request)
    {
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
            'email' => 'required|email:rfc,dns|unique:users,email',
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
        $code = $this->createAndSendCode($request->email);
        return redirect("/code")->with(["email"=>$request->email]);
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
}
