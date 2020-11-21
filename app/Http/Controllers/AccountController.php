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

    	$user = User::find(Auth::id());
    	$result = $this->eventcheck($request,$user);
       
    	return view('account')->with(['user'=>$user,'result'=>$result]);
    }


    private function eventcheck($request,$user){
    	if(isset($request->event)){

    		if($request->event=="update_info"){
    			if(isset($request->first_name))
    				$user->first_name = $request->first_name;
    			if(isset($request->last_name))
    				$user->last_name = $request->last_name;
    			if(isset($request->company_name))
    				$user->company_name = $request->company_name;
    			if(isset($request->location))
    				$user->location = $request->location;
    			
    			$user->save();
                return ['event'=>'update_info','result'=>true];
    		} else if($request->event == "change_password"){
                // Доделать вывод нормальной информации

                if(Hash::check($request->old_password,$user->password)){
                    if($request->new_password == $request->new_password2){
                        $user->password = password_hash($request->new_password, PASSWORD_BCRYPT);
                        $user->save();
                        return ['event'=>'change_password','result'=>true];
                    } else return ['event'=>'change_password','result'=>false];
                } else return ['event'=>'change_password','result'=>false];
            }
    	} else return array();
    }

    public function getPay(Request $request){
        
        $transaction = Square::charge([
            'amount' => (int)$request->amount, 
            'source_id' => 'cnon:CBASEA_Q6xyHIBxwRNHJf5J-eo0',//$request->cardnonce,
            'location_id' => env('SQUARE_LOCATION'),
            'currency' => 'USD'
        ]);
        
        // Дополнительные проверки по стоимости и транзакциям нужны
        if($transaction){
            $payments = Payments::where([['user_id',Auth::user()->id],['status',Payments::PENDING]])->get();
            foreach ($payments as $p) {
                $p->status=Payments::PAID;
                $p->save();
            }
        }
        return redirect('dashboard');
    }
}
