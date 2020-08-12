<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class ImageAboutController extends Controller
{
	/*check user, */
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();
    }

	public function index()
    {
    	/*Kiểm tra đăng nhập*/
		$this->AuthLogin();

    	$array_image = DB::table('tbl_about')->get();
    	return view('admin.image_about.all_image_about')->with("array_image", $array_image);
    }
    /*end: public function save_image(Request $require)*/

    /*save imgae about page home in about*/
    public function save_image(Request $request)
    {
    	/*Kiểm tra đăng nhập*/
		$this->AuthLogin();

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

    public function del($id)
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        DB::table('tbl_about')->where('id', $id)->delete();

        Session::put('message', 'Xoá thành công');
        return Redirect::to('all-image-about');
    	
    }
    /*end: public function save_image(Request $require)*/

    /*begin: un active image in about page home*/
    public function active_or_unactive_image_about($id)
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        /*truy vấn dữ liệu để lấy thông tin hình ảnh theo id*/
       	$array_image_about = DB::table('tbl_about')->where("id", $id)->first();

       	if($array_image_about != NULL)
       	{
       		print_r($array_image_about);
	       	$status_image = $array_image_about->status;

	       	/*Nếu đã active thì unactive nếu chưa thì active thành status = 2*/
	       	$array_update_image = array();
	       	if($status_image == "2") $array_update_image['status'] = "1";
			else $array_update_image['status'] = "2";
			
			DB::table('tbl_about')->where("id", $id)->update($array_update_image);
	        Session::put('message', 'Chỉnh sửa thành công');
	        return Redirect::to('all-image-about');
    	}
    	/*end: if($array_image_about != NULL)*/
    	Session::put('message', 'Chỉnh sửa thất bại');
    	return Redirect::to('all-image-about');
    }
    /*end: function active_or_unactive_image_about($id)*/

}
