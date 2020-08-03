<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	/*begin: trang dashboard*/
    public function dashboard()
    {
    	return view("admin.dashboard");
    }
    /*end: function dashboard()*/
}
