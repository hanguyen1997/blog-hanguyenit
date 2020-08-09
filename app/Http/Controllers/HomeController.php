<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
	/*Trang chủ home*/
	public function index()
	{
		$array_blog = DB::table('tbl_blogs')->get();
    	return view('pages.home')->with("array_blog", $array_blog);
    }
    /*End: public function index()*/
}
