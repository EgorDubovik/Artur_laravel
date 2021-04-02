<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;
use Hash;
use App\Payments;
use App\User;
use Nikolag\Square\Facades\Square;
use Nikolag\Square\Models\Customer;


class AccountSettingsController extends Controller
{
    public function account(Request $request){
    	$user = Auth::user();
    	return view('account')->with('user',$user);
    }

    public function updateUserInformation(Request $request){
        $user = Auth::user();
        $user->update($request->all());
        $user->save();
        
        return redirect()->route('account')->with('success_inf','Successful save');
    }

    public function updatePass(Request $request){
        $user = Auth::user();
        $key = 'error_pass';
        $mes = 'Successful save';
        if(Hash::check($request->old_password,$user->password)){
            if($request->new_password == $request->new_password2 && strlen($request->new_password2)>=8){
                $user->password = password_hash($request->new_password, PASSWORD_BCRYPT);
                $user->save();
                $key = 'success_pass';
            } else 
                $mes = 'Passwords must match and be at least 8 characters long';
        } else $mes = 'You entered the wrong old password';
        return redirect()->route("account")->with($key,$mes);
    }
}
