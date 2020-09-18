<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UserGroup;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class UserGroupController extends Controller
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
    /*end:  public function AuthLogin()*/

	/*list user group by ajax*/
    public function index(){

    	/*check user*/
    	$this->AuthLogin();

    	/*connect db*/
    	$array_user_group = UserGroup::all();

    	/*check $array_user_group*/
    	if($array_user_group == null)
        {
            echo "<tr><td colspan='3' style='text-align: center;>Không có dữ liệu</td></tr>";
        }
        else
        {
        	$content = "";
        	foreach($array_user_group as $key => $value)
        	{
	        	$content .= "<tr>
			            <td>".$value->user_group_name."</td>
			            <td>".$value->user_group_des."</td>
			            <td>
			            	<button style='background:#57a957;'>
				              <a style='color:white' href='#' >Sửa</a>
				            </button>
				            <button name='button_del_user_group' data-id_user_group='".$value->id_user_group."' id='button_del_user_group' style='background:red;'>
				              Xoá
				            </button>
			            </td>
			          </tr>";
		    }
		    /*end: foreach($array_user_group as $key => $value)*/
		    echo $content;
        }
        /*end: if($array_user_group == null)*/
    }
    /*end: function index()*/

    /*begin: check user_name_group by ajax*/
    public function check_name_user_group(Request $request){
    	$user_group_name = $request->user_group_name;
    	$check_user_group_name = UserGroup::Where("user_group_name", $user_group_name)->get();
        
        /*if $check_user_group_name != null name already exists and if $check_user_group_name == null name oke*/
    	if(!$check_user_group_name) echo "check_not_oke";
    	else echo "check_ok";
    }
    /*end: public function check_name_user_group(Request $request)*/

    /*begin: save user_group by ajax*/
    public function save_user_group(Request $request){
        $user_group_name = $request->user_group_name;
        $user_group_desc = $request->user_group_desc;

        $array_user_group = null;
        $array_user_group["user_group_name"] = $user_group_name;
        $array_user_group["user_group_des"] = $user_group_desc;

        UserGroup::insert($array_user_group);

        echo "save";
    }
    /*end: public function save_user_group(Request $request)*/

    /*begin: del user_name_group by ajax*/
    public function del_name_user_group(Request $request){

    	/*check user*/
    	$this->AuthLogin();

    	/*Lấy id từ request trả về*/
    	$id_user_group = $request->id_user_group;

    	/*nếu id_user_group == 1 là admin thì không thể xoá admin đc và id_user_group không đc bằng rỗng*/
    	if($id_user_group == "1" || $id_user_group == "") echo "not_done";
    	else
    	{
	    	/*del user_group = id*/
	    	$del_user_group = UserGroup::Where("id_user_group", $id_user_group)->delete();
	    	echo "done";
	    }
	    /*end: if($id_user_group == "1" || $id_user_group == "")*/
    }
    /*end: function del_name_user_group*/
}
