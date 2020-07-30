<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class DashBoardController extends Controller
{
    //

    public function dashboard(Request $request){
    	$user = User::find(Auth::id());
    	return view("dashboard");
    }
}
