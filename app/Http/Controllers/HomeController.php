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

		$array_image_blog = DB::table('tbl_about')->where("type", "image")->where("status", "1")->get();

    	return view('pages.home')->with("array_blog", $array_blog)->with("array_image_blog", $array_image_blog);
    }
    /*End: public function index()*/
}
