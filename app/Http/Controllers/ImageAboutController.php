<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class ImageAboutController extends Controller
{
	public function index()
    {
    	$array_image = DB::table('tbl_about')->get();
    	return view('admin.image_about.all_image_about')->with("array_image", $array_image);
    }
    /*end: public function save_image(Request $require)*/

    /*save imgae about page home in about*/
    public function save_image(Request $request)
    {
    	$get_image = $request->file('image_about');

		$get_name_image = $get_image->getClientOriginalName();

		/*Hàm current lấy thâm số đầu sau dấu chấm của ảnh*/
		$name_image = current(explode(".", $get_name_image));
		$new_image = $name_image.rand(0,99).".".$get_image->getClientOriginalExtension();
		$get_image->move('public/uploads', $new_image);

		$array_about['image'] = $new_image;
		$array_about['type'] = "image";
		$array_about['content'] = "";
		$array_about['status'] = "1";

		DB::table('tbl_about')->insert($array_about);
		Session::put('message','Thêm hình ảnh thành công');
		return Redirect::to('all-image-about');
    }
    /*end: public function save_image(Request $require)*/



}
