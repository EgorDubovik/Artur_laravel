<?php

namespace App\Http\Controllers;

use App\TransactionView;
use Illuminate\Http\Request;
use App\Payments;
use Auth;

class TransactionViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $reqest,$transaction_id)
    {
        $payment = Payments::find(['id'=>$transaction_id])->first();
        
        if($payment->user_id == Auth::user()->id || Auth::user()->is_admin()){
            $data = [];    
            foreach ($payment->userServices as $userServices) {
                if(!in_array($userServices->service->parent->id, $data)){
                    $data[$userServices->service->parent->id]['parentTitle']=$userServices->service->parent->title;
                }
                $data[$userServices->service->parent->id]['services'][] = $userServices;
            }
            $return = [
                'total'=>$payment->amount,
                'payment'=>$data,
            ];
            return view('transaction-view')->with($return);
        }
        else {
            return redirect()->back();
        }
    }

    
}
