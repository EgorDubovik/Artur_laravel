<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
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


    public function random(Request $request){

    	$links = Random::all();

		$array_ver = [0];
		foreach ($links as $key => $link) {
			$array_ver[]=$array_ver[count($array_ver)-1]+$link->chance;
		}
		
		$random_number = rand(0,$array_ver[count($array_ver)-1]);
		for ($j=1; $j < count($array_ver); $j++) { 
			if($random_number>$array_ver[$j-1] && $random_number<=$array_ver[$j])
			{
				$col = $links->get($j-1);
				$col->count_use = $col->count_use+1;
				$col->save();
				return Redirect::to($col->title);
			}
		}

		
    }
}
