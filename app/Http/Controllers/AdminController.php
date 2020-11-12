<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AdminController extends Controller
{
    
	public function addNewUser(Request $request){

		return "add user form";
	}

	public function listUsers(Request $request){
		$user = User::find(Auth::id());
		return view("admin.users");
	}

}
