<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	/*begin: show list user by ajax*/
    public function index(){
    	$array_user = User::all();

    	/*if it does not exist the user will resend the message*/
    	if($array_user == NULL)
    	{
    		echo "<p>Không tồn tại dữ liệu người dùng</p>";
    	}
    	else{
    		$content = "";
    		foreach ($array_user as $key => $user) {
    			$content .= "<tr>
                                <td>".$user->name."</td>
                                <td>".$user->email."</td>
                                <td>Admin</td>
                                <td>
                                <button style='background:red;'>
                                	<a style='color:white' href='#' data-id='".$user->id."' >Xoá</a>
                                </button>
                                <button  style='background:#6464f3;'>
                                	<a style='color:white' href='#' data-id='".$user->id."'>Chi tiết</a>
                                </button>
                                <button  style='background:#57a957;'>
                                	<a style='color:white' href='#' data-id='".$user->id."'>Đổi mật khẩu</a>
                                </button>
                                </td>
                            </tr>";
            }
            /*end: foreach ($array_image as $key => $user) */
            echo $content;
    	}
    	/*end: if($array_user == NULL)*/
    }
    /*end: public function index(){*/
}
/*end: class UserController extends Controller*/
