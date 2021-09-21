<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Gallery;

class GalleryController extends Controller
{
    private $folderPath = 'uploads';


    public function view(Request $request){
    	$images = Gallery::all();
    	return view('admin.gallery')
    		->with('images',$images);
    }

    public function upload(Request $request){
    	$file = $request->file('file');
    	$new_name = getRandomFileName(50).'.'.$file->extension();

    	Gallery::create([
    		'name'=>$new_name,
    		'is_active'=>1
    	]);

    	$file->move($this->folderPath,$new_name);
		return back()->with('success','File uploaded successfully');
    }

    public function remove(Request $request){
    	$image = Gallery::find($request->id);
    	$image->delete();
    	if(File::exists($this->folderPath.'/'.$image->name)) {
    		File::delete($this->folderPath.'/'.$image->name);
		}
    	return back()->with('success','File uploaded successfully');
    }
}
