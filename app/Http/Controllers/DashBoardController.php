<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payments;
use Auth;

class DashBoardController extends Controller
{
    //

    public function dashboard(Request $request){
    	

    	$payments = Payments::where('user_id',Auth::user()->id)->get();
    	$total = 0;
    	foreach ($payments as $payment) {
    		$total+=$payment->amount;
    	}

    	return view("dashboard")->with(['total'=>$total,'payments'=>$payments]);
    }
}
