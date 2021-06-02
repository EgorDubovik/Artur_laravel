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

    public function edit(Request $request)	
    {
    	$input = $request->validate([
                'title' => 'required',
                'chance' => 'required',
                'link_id' => 'required',
        ]);

        $rand = Random::find($request->link_id);
        $rand->title = $request->title;
        $rand->chance = $request->chance;
        $rand->save();

        return back()->with('successful','Edit successful');
    }

    public function remove(Request $request, $id)
    {
    	$rand = Random::find($id);
    	$rand->delete();

    	return back()->with('successful','Remove successful');
    }
}
