<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
	/*Trang chủ home*/
	public function index()
	{
		/*truy vấn dữ liệu tbl_blogs ramdom 3 and trạng thái: hiển thị*/
		$array_blog = DB::table('tbl_blogs')->where("blog_status", "1")->get()->random(3);

		/*select tbl_about hiển thị type image and trạng thái: hiển thị*/
		$array_image_blog = DB::table('tbl_about')->where("type", "image")->where("status", "1")->get();
    	return view('public.pages.home')->with("array_blog", $array_blog)->with("array_image_blog", $array_image_blog);
    }
    /*End: public function index()*/

    /*liên hệ ajax*/
	public function contact(Request $request)
	{
		$array_contact = $request->all();

		echo "oke";
    }
    /*End: public function index()*/
    
}
