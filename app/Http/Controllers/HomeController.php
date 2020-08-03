<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
	/*Trang chủ home*/
	public function index()
	{
		$array_post = DB::table('tbl_posts')->get();
    	return view('pages.home')->with("array_post", $array_post);
    }
    /*End: public function index()*/
}
