<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Contact;
use App\Blog;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
	/*check user, */
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();
    }
    /*end: public function AuthLogin()*/

	/*begin: check login form đăng nhập dadmin*/
    public function check_login(Request $request)
    {
    	$user_email = $request->user_email;
    	$user_password = MD5($request->user_password);
    	$array_user = db::table("tbl_users")->where("email", $user_email)->where("password", $user_password)->first();
    	
    	/*Nếu có user tồn tại thì lưu vào section*/
    	if($array_user != NULL)
    	{
    		Session::put("user_name", $array_user->name);
    		Session::put("user_email", $user_email);
            Session::put("user_id", $array_user->user_id);
            Session::put("user_group_id", $array_user->user_group_id);
            Session::put("image", $array_user->image);
    		

    		/*Chuyển đến trang dasboard*/
    		return Redirect('/dashboard');
    	}
    	else
    	{
    		/*không trùng tài khoản*/ 
	        Session::put('message', "Tài khoản hoặc mật khẩu sai (vui lòng nhập lại)");
	        return Redirect::to('/admin');
    	}
    	/*end: if($array_user != NULL)*/
    }
    /*end: function check_login(Request $request)*/

	/*begin: trang dashboard*/
    public function dashboard()
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        // Đếm toàn bộ số lượt xem bài viết
        $count_view_blog =  Blog::sum("viewcount");


        // Đếm toàn bộ số rows liên hệ gửi đến web trong table contact
        $count_contact =  Contact::count();

        // Đếm toàn bộ số bài viết hiện thị trên trang web table tbl_blog
        $count_blog =  DB::table('tbl_blogs')->where("blog_status", "=", "1")->count();

        /*Lấy danh sách blog nhiều view nhất*/
        $array_blog_most_view =  Blog::orderByRaw('viewcount', "DESC")->limit(6)->get();
        
    	return view("admin.dashboard.index")->with("count_contact", $count_contact)->with("count_blog", $count_blog)->with("count_view_blog", $count_view_blog)->with("array_blog_most_view", $array_blog_most_view);
    }
    /*end: function dashboard()*/

    /*begin: logout*/
    public function logout()
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();
    	
    	Session::put('user_id', NULL);
    	Session::put('user_name', NULL);
        Session::put('user_email', NULL);
        Session::put('user_group_id', NULL);
        Session::put('image', NULL);

    	/*Chuyển về trang đăng nhập*/
    	return Redirect::to("/admin");	
    }
    /*end: function dashboard()*/
}
