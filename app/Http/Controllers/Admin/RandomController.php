<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Random;
class RandomController extends Controller
{
	
    public function view(Request $request)
    {
    	$links = Random::all();
    	return view('admin.random')->with('links',$links);
    }

    public function add(Request $request)
    {
    	$input = $request->validate([
                'title' => 'required',
                'chance' => 'required',
        ]);

        Random::create([
        	'title'=>$request->title,
        	'chance'=>$request->chance,
        	'count_use'=>0,
        ]);

        return back()->with('successful','Save successful');
    }
}
