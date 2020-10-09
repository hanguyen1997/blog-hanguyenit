<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class UserController extends Controller
{
	/*check user*/
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        $user_group_id = Session::get('user_group_id');

        /*if the user is an admin, allow access, admin is user_group_id = 1*/ 
        if($user_group_id != "1") return Redirect::to('/admin')->send();
        if($user_id == "") return Redirect::to('/admin')->send();
    }

	/*begin: show list user*/
    public function index(){
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

    	$array_user = User::where("status", "<>", "2")->get();
        return view('admin.user.index')->with("array_user", $array_user);
    }
    /*end: public function index(){*/

    /*begin: delete user*/
    public function delete($user_id){
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

    	/*DELETE FROM tbl_users where user_id = $user_id*/ 
    	$array_user = User::where("user_id",$user_id)->get();

        /*check user*/
        if($array_user != null)
        {
            $array_delete = null;
            $array_delete['status'] = "2";
            User::where("user_id",$user_id)->update($array_delete);
            
            Session::put("message", "Xoá thành công");
            return redirect('/list-user');
        }
        /*end if($array_user != null)*/

    	Session::put("message", "Xoá không thành công");
        return redirect('/list-user');
    }
    /*end: public function delete($user_id)*/
}
/*end: class UserController extends Controller*/
