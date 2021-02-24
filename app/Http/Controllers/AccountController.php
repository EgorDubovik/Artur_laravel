<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Log;
use Hash;
use App\Payments;
use Nikolag\Square\Facades\Square;
use Nikolag\Square\Models\Customer;


class AccountController extends Controller
{
    public function account(Request $request){
    	$user = Auth::user();
    	return view('account')->with('user',$user);
    }

    public function update_user_info(Request $request){
        $user = Auth::user();
        $user->update($request->all());
        $user->save();
        
        return redirect()->route('account')->with('success_inf','Successful save');
    }

    public function update_pass(Request $request){
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

   

    public function getPay(Request $request){
        
        $transaction = false;
        $isset_tr = false;
        if($request->amount>0){
            if($request->has("cardnonce") && $request->cardnonce!="def")
                $transaction = Square::charge([
                    'amount' => (int)$request->amount, 
                    'source_id' => $request->cardnonce,
                    'location_id' => env('SQUARE_LOCATION'),
                    'currency' => 'USD'
                ]);
        }
        
        // Дополнительные проверки по стоимости и транзакциям нужны
        if($transaction){

            $payments = Payments::where([['user_id',Auth::user()->id],['status',Payments::PENDING]])->get();
            foreach ($payments as $p) {
                $p->status=Payments::PAID;
                $p->save();
            }
            $isset_tr = true;
        }
        return redirect('dashboard')->with(['isset_tr'=>$isset_tr,'status'=>$transaction]);
    }
}
