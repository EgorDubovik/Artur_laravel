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
    	

    	$payments_peiding = Payments::where([['user_id',Auth::user()->id],['status',Payments::PENDING]])->get();
    	$total = 0;
    	foreach ($payments_peiding as $payment) {
    		$total+=$payment->amount;
    	}
    	$payments_paid = Payments::where([['user_id',Auth::user()->id],['status',Payments::PAID]])->get();

    	return view("dashboard")->with(['total'=>$total,'payments_peiding'=>$payments_peiding,'payments_paid'=>$payments_paid]);
    }
}
