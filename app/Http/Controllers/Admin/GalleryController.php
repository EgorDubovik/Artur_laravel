<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    private $folderPath = 'uploads';


    public function view(Request $request){
    	return view('admin.gallery');
    }

    public function upload(Request $request){
    	$file = $request->file('file');
    	$file->move($this->folderPath,$file->getClientOriginalName());
		return back()->with('success','File uploaded successfully');
    }
}
