<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payments;
use App\UserServices;
use Auth;

class DashBoardController extends Controller
{
    //

    public function dashboard(Request $request){
    	

    	$payments_peiding = Payments::where([['user_id',Auth::user()->id],['status',Payments::PENDING]])->get();
    	
        $payments_data = [];

        foreach ($payments_peiding as $payment) {
            $data = [];    
            foreach ($payment->userServices as $userServices) {
                if(!in_array($userServices->service->parent->id, $data)){
                    $data[$userServices->service->parent->id]['parentTitle']=$userServices->service->parent->title;
                }
                $data[$userServices->service->parent->id]['services'][] = $userServices;
            }
            $payments_data[] = $data;
        }

        $total = 0;
        foreach ($payments_peiding as $payment) {
    		$total+=$payment->amount;
    	}
    	$payments_paid = Payments::where([['user_id',Auth::user()->id],['status',Payments::PAID]])->get();
        $return = [
            'total'=>$total,
            'payments_peiding'=>$payments_data,
            'payments_paid'=>$payments_paid
        ];
    	return view("dashboard")->with($return);
    }
}
