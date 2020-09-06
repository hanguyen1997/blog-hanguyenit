<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class UserController extends Controller
{
	/*begin: show list user*/
    public function index(){
    	$array_user = User::all();
        return view('admin.user.index')->with("array_user", $array_user);
    }
    /*end: public function index(){*/

    /*begin: delete user*/
    public function delete($user_id){
    	/*DELETE FROM tbl_users where user_id = $user_id*/ 
    	$array_user = User::where("user_id",$user_id)->delete();
    	Session::put("message", "Xoá thành công");
        return redirect('/list-user');
    }
    /*end: public function delete($user_id)*/
}
/*end: class UserController extends Controller*/
