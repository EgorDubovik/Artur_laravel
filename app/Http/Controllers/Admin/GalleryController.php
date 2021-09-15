<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    private $folder = '';


    public function view(Request $request){

    	return view('admin.gallery');
    }
}
