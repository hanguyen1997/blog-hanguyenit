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
			            	<button id='button_edit_user_group' name='button_edit_user_group' style='background:#57a957;' data-id_user_group='".$value->id_user_group."'>Sửa
				            </button>
				            <button name='button_del_user_group' data-id_user_group='".$value->id_user_group."' id='button_del_user_group' style='background:red;'>Xoá
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
    	if($check_user_group_name->isEmpty()) echo "check_ok";
    	else echo "check_dont_ok";
    }
    /*end: public function check_name_user_group(Request $request)*/

    /*begin: save user_group by ajax*/
    public function save_user_group(Request $request){
        $user_group_name = $request->user_group_name;
        $user_group_desc = $request->user_group_desc;
        $id_user_group = $request->id_user_group;

       

        /*if user_group_desc and user_group_name == "" redirect page list user group*/
        if($user_group_name == "" || $user_group_desc == "") return redirect("/list-user-group");

        /*check id_user_group if id_user_group != "" is a edit*/
        if($id_user_group != "") return $this->update_user_group($id_user_group, $user_group_name, $user_group_desc);

        /*check user_name_group*/
        $check_user_group_name = UserGroup::Where("user_group_name", $user_group_name)->get();
        
        /*check array check_user_group_name != NUll*/
        if($check_user_group_name->isEmpty())
        {
            $array_user_group = null;
            $array_user_group["user_group_name"] = $user_group_name;
            $array_user_group["user_group_des"] = $user_group_desc;

            /*INSERT INTO tbl_user_user_groups (user_group_name, user_group_des) VALUES ($user_group_name, $user_group_desc)*/
            UserGroup::insert($array_user_group);
            echo "save";
        }else echo "exit";
        /*end: if($check_user_group_name->isEmpty())*/

        return;
       
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

    /*begin: query user_group data by method id ajax*/
    public function eidt_user_group(Request $request){
        $id_user_group = $request->id_user_group;
        if($id_user_group != "")
        {
            $array_user_group = UserGroup::Where("id_user_group",$id_user_group)->get();
            echo json_encode($array_user_group);
            return;
        } 
        echo "not oke"; 
    }
    /*end: function eidt_user_group(Request $request)*/

    /*begin: update user_group data by method id ajax*/
    public function update_user_group($id_user_group, $user_group_name, $user_group_desc){

        /*Check that the name already exists and is different from the current id*/
        $check_user_group_name = UserGroup::Where("user_group_name", $user_group_name)->Where("id_user_group", "<>", $id_user_group)->get();

        /*check check_user_group_name != NULL, if survive and exit*/
        if($check_user_group_name->isEmpty())
        {
            $array_update_user_group = null;
            $array_update_user_group["user_group_name"] = $user_group_name;
            $array_update_user_group["user_group_des"] = $user_group_desc;

            /*INSERT INTO tbl_user_user_groups (user_group_name, user_group_des) VALUES ($user_group_name, $user_group_desc)*/
            UserGroup::Where("id_user_group", $id_user_group)->update($array_update_user_group);
            echo "update";
        }
        else echo "exit";
        /*end: if($check_user_group_name->isEmpty())*/
    }
    /*end: function update_user_group($id_user_group, $user_group_name, $user_group_desc)*/
}
