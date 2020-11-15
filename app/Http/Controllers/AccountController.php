<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Log;
use Nikolag\Square\Facades\Square;
use Nikolag\Square\Models\Customer;


class AccountController extends Controller
{
    public function account(Request $request){

    	$user = User::find(Auth::id());
    	$this->eventcheck($request,$user);
    	return view('account')->with(['user'=>$user]);
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
    			
    		}
    	}
    }

    public function getPay(Request $request){
        
        // $transaction = Square::charge([
        //     'amount' => (int)$request->amount, 
        //     'source_id' => 'cnon:CBASEA_Q6xyHIBxwRNHJf5J-eo0',//$request->cardnonce,
        //     'location_id' => env('SQUARE_LOCATION'),
        //     'currency' => 'USD'
        // ]);
        
        //dd($transaction);
        return redirect('dashboard')
    }
}
