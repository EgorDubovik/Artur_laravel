<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class FBAController extends Controller
{
    public function createFBA(Request $request){
    	$user = User::find(Auth::id());

    	return view('fba.create')->with(['user'=>$user]);


    }
}
