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

    /*Begin: save user new*/
    public function save(Request $request){
        /*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        /*Kiểm tra email đã tồn tại chưa*/
        $user_email = $request->user_email;
        $array_check_user = User::where("email", $user_email)->first();

        /*kiểm tra tồn tại email không và hiển thị thông báo*/
        if($array_check_user != null)
        {
            Session::put("message", "Thêm mới thành viên không thành công, email này đã tồn tại");
            return redirect('/form-add-user');
        }

        /*Xác thực mật khẩu*/
        $password = $request->user_password;
        $check_user_password = $request->check_user_password;
        if($password != $check_user_password)
        {
            Session::put("message", "Thêm mới thành viên không thành công, email xác thực không đúng");
            return redirect('/form-add-user');
        }

        /*lưu vào bảng user*/
        $array_save_user = null;
        $array_save_user['name'] = $request->user_name;
        $array_save_user['email'] = $request->user_email;
        $array_save_user['user_group_id'] = $request->user_group_id;
        $array_save_user['sex'] = $request->user_sex;
        $array_save_user['password'] = md5($password);
        $array_save_user['status'] = "1";
        User::insert($array_save_user);

        /*chuyển về trang danh sách và in thông báo thành công*/
        Session::put("message", "Thêm mới thành viên thành công");
        return redirect('/list-user');
    }
    /*end: public function save(){*/

    /*Begin: check email user */
    public function check_email_user(Request $request){
        $user_email = $request->user_email;

        /*kiểm tra user_email đã tồn tại chưa*/
        $array_user = User::where("email", $user_email)->first();

        /*kiểm tra tồn tại email không và hiển thị thông báo*/
        if($array_user != null) echo "not oke";
        else echo "oke";

    }
    /*end: function check_email_user(Request $request)*/

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

    /*Begin detail user*/
    public function detail($user_id = ""){
        /*Kiểm tra đăng nhập*/
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();

        /*nếu là admin thì có quyền xem đc tất cả detail của user và không phải thì chỉ xem đc người đó thôi*/
        $user_group_id = Session::get('user_group_id');

        if($user_group_id == "1")
        {
            $array_user = User::where("user_id", $user_id)->get();
            return view('admin.user.detail')->with("array_user", $array_user);
        }else
        {
            $id_user = Session::get("user_id");
            $array_user = User::where("user_id", $id_user)->get();
            return view('admin.user.detail')->with("array_user", $array_user);
        }   
        /*end: if($user_group_id == 1)*/
    }
}
/*end: class UserController extends Controller*/
