<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;


class UserTableController extends Controller
{
    public function view(Request $request)
    {
    	return view('admin.product_view_table');
    }
}
