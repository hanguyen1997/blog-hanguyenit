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
        $array_save_user['image'] = "";
        $array_save_user['phone'] = "";
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
        $id_user = Session::get("user_id");
        if($id_user == "") return Redirect::to('/admin')->send();

        /*nếu là admin thì có quyền xem đc tất cả detail của user và không phải thì chỉ xem đc người đó thôi*/
        $user_group_id = Session::get('user_group_id');

        if($user_group_id == "1") $array_user = User::where("user_id", $user_id)->get();
        else $array_user = User::where("user_id", $id_user)->get();

        return view('admin.user.detail')->with("array_user", $array_user);
    }

    /*Begin edit user*/
    public function edit(Request $request, $user_id){
        
        /*Kiểm tra đăng nhập*/
        $id_user = Session::get("user_id");
        if($id_user == "") return Redirect::to('/admin')->send();

        /*chỉnh sửa thông tin user từ $user_id)*/
        $array_user = User::where("user_id",$user_id)->first();
        $array_user->name =  $request->user_name;
        $array_user->phone =  $request->user_phone;
        $array_user->sex =  $request->user_sex;
        if($request->id_user_group != "") $array_user->user_group_id = $request->id_user_group;

        /*Kiểm tra có hình ảnh khong, nếu không có thì khoong luuw*/
        if($request->file('image'))
        {
            $get_image = $request->file('image');
            $get_name_image = $get_image->getClientOriginalName();

            /*Hàm current lấy thâm số đầu sau dấu chấm của ảnh*/
            $name_image = current(explode(".", $get_name_image));
            $new_image = $name_image.rand(0,99).".".$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images', $new_image);
            $array_user->image = $new_image;

            /*Lưu vào ảnh vào session*/
            Session::put("image", $new_image);
        }
        /*End: if($get_image)*/

        /*update*/
        $array_user->save();

        /*đặt thông điệp thành công và quai lại trang detail*/
        Session::put("message", "Chỉnh sửa thành côngg");
        return redirect('/detail-user/'.$user_id); 
    }
    /*end: function edit(Request $request, $user_id)*/

    /*change password by admin*/
    public function change_password(Request $request, $user_id){

        /*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        $user_password_new = $request->user_password_new;
        $check_user_password_new = $request->check_user_password_new;

        /*Mật khẩu xác thực không giống mật khẩu mới*/
        if($user_password_new != $check_user_password_new){
        Session::put("message", "Mật khẩu xác thực không khớp mật khẩu mới");
           return redirect('/change-password-user/$user_id'); 
        }
        /*end: if($user_password_new != $check_user_password_new)*/

        /*Lưu mật khẩu mới vào id_user*/
        $array_change_password = User::where("user_id", $user_id)->first();
        $array_change_password['password'] = md5($check_user_password_new);
        $array_change_password->save();
        Session::put("message", "Thay đổi mật khẩu thành công");
        return redirect('/list-user'); 
                
    }
    /*end: public function change_user(Request $request)*/
}
/*end: class UserController extends Controller*/
