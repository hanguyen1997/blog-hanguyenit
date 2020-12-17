<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Blog;
use App\Contact;

class HomeController extends Controller
{
	/*Trang chủ home*/
	public function index()
	{
		/*truy vấn dữ liệu tbl_blogs*/ 
		$array_blog = Blog::where("blog_status", "1")->get();

		/*ramdom 3 and trạng thái: hiển thị*/
		if (!$array_blog->isEmpty() && count($array_blog) > 3) {
		    $array_blog = $array_blog->random(3);
		}

		/*select tbl_about hiển thị type image and trạng thái: hiển thị*/
		$array_image_blog = DB::table('tbl_about')->where("type", "image")->where("status", "1")->get();
    	return view('public.pages.home')->with("array_blog", $array_blog)->with("array_image_blog", $array_image_blog);
    }
    /*End: public function index()*/

    /*liên hệ ajax*/
	public function contact(Request $request)
	{
		/*Lấy dữ liệu về bằng request*/
		$data = $request->all();

		/*lưu vào vào data model Contact*/
		$array_contact = new Contact();
		$array_contact->user_name = $data['name_contact'];
		$array_contact->email = $data['email_contact'];
		$array_contact->message = $data['message_contact'];
		$array_contact->save();

		/*in ra oke để trả về ajax*/
		echo "oke";
    }
    /*End: function contact(Request $request)*/   
}
