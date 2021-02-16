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
    	$result = $this->eventcheck($request,$user);
       
    	return view('account')->with(['user'=>$user,'result'=>$result]);
    }


    private function eventcheck($request,$user){
    	if(isset($request->event)){

    		if($request->event=="update_info"){
                $user->update($request->all());
    			$user->save();
                return ['event'=>'update_info','result'=>true];
    		} else if($request->event == "change_password"){
                // Доделать вывод нормальной информации

                if(Hash::check($request->old_password,$user->password)){
                    if($request->new_password == $request->new_password2 && strlen($request->new_password2)>=8){
                        $user->password = password_hash($request->new_password, PASSWORD_BCRYPT);
                        $user->save();
                        return ['event'=>'change_password','result'=>true];
                    } else return ['event'=>'change_password','result'=>false];
                } else return ['event'=>'change_password','result'=>false];
            }
    	} else return array();
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
