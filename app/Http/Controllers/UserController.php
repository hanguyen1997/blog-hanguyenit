<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	/*begin: show list user by ajax*/
    public function index(){
    	$array_user = User::all();
    	
        return view('admin.user.index')->with("array_user", $array_user);
    }
    /*end: public function index(){*/
}
/*end: class UserController extends Controller*/
