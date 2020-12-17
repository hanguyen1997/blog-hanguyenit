<?php
namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ContactController extends Controller
{
	/*check user */
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();
    }
    /*end: public function AuthLogin()*/

	/*list contact by ajax*/
    function index()
    {
    	/*kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	/*truy vấn dữ liệu bằng model*/
    	$array_contact = Contact::get();

    	/*Kiểm tra dữ liệu có tồn tại không*/
    	if($array_contact == null)
    	{
    		echo "<tr><td colspan='4' style='text-align: center;'>Không có dữ liệu</td></tr>";
    	}
    	else 
    	{	
    		foreach ($array_contact as $key => $value) {
    			echo "<tr>
			            <td>".$value->user_name."</td>
			            <td>".$value->email."</td>
			            <td>".$value->message."</td>
			            <td>
			              <button data-id_contact='".$value->id_contact."' style='color: red;' id='button_del_contact' name='button_del_contact'>Xoá
			              </button>
			            </td>
			          </tr>";
		    }
		    /*end: foreach ($array_contact as $key => $value)*/      
    	}
    	/*end: if(!$array_contact)*/
   	}
   	/*end: function index()*/

   	/*delete contact by ajax*/
    function ajax_del(Request $request)
    {
    	/*kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	/*Lấy id*/
    	$id_contact = $request->id_contact;

    	$array_contact = Contact::where("id_contact",$id_contact);
    	$array_contact->delete();
        
    	echo "done";
   	}
   	/*end: function index()*/
}
