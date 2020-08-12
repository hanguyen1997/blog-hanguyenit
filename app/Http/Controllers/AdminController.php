<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
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

	/*begin: check login form admin*/
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

    		/*Chuyển đến trang dasboard*/
    		return Redirect('/dashboard');
    	}
    	else
    	{
    		/*không trùng tài khoản*/ 
	        Session::put('message', "Tài khoản hoặc mật khẩu sai (vui lòng nhập lại)");
	        return Redirect::to('/form-login');
    	}
    	/*end: if($array_user != NULL)*/
    }
    /*end: function dashboard()*/


	/*begin: trang dashboard*/
    public function dashboard()
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

    	return view("admin.dashboard");
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

    	/*Chuyển về trang đăng nhập*/
    	return Redirect::to("/admin");	
    }
    /*end: function dashboard()*/
}
