<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
	/*begin: list all post blog*/
    public function index()
    {	
    	$array_post = DB::table('tbl_posts')->get();
    	return view('admin.index_post')->with('array_post', $array_post);
    }
    /*end: public function index()*/
}
