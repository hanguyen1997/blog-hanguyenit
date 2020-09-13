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
			            	<button  style='background:#57a957;'>
				              <a style='color:white' href='#' >Sửa</a>
				            </button>
				            <button style='background:red;'>
				              <a style='color:white' href=''>Xoá</a>
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
    	$check_user_group_name = UserGroup::Where("user_group_name", "$user_group_name")->get();

    	if($check_user_group_name == "") echo "check_ok";
    	else echo "check_not_ok";
    }
    /*end: public function check_name_user_group(Request $request)*/
}
