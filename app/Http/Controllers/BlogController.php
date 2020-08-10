<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogController extends Controller
{
	/*begin: list all post blog*/
    public function index()
    {	
    	$array_blog = DB::table('tbl_blogs')->get();
    	return view('admin.blogs.all_blog')->with('array_blog', $array_blog);
    }
    /*end: public function index()*/

    /*begin: save post blog new*/
    public function save(Request $request)
    {	
	    $array_blog_new = array();
	    $array_blog_new['blog_title'] = $request->blog_title;
	    $array_blog_new['blog_code'] = $request->blog_code;
	    $array_blog_new['blog_description'] = $request->blog_description;
	    $array_blog_new['blog_content'] = $request->blog_content;
	    $array_blog_new['blog_status'] = $request->blog_status;
	    $get_image = $request->file('blog_image');

	    /*Kiểm tra có hình ảnh khong*/
		if($get_image)
		{
			$get_name_image = $get_image->getClientOriginalName();

			/*Hàm current lấy thâm số đầu sau dấu chấm của ảnh*/
			$name_image = current(explode(".", $get_name_image));
			$new_image = $name_image.rand(0,99).".".$get_image->getClientOriginalExtension();
			$get_image->move('public/uploads', $new_image);
			$array_blog_new['blog_image'] = $new_image;
			DB::table('tbl_blogs')->insert($array_blog_new);
			Session::put('message','Thêm sản phẩm thành công');
			return Redirect::to('all-blog');
		}
		/*End: if($get_image)*/
		
		$array_blog_new['blog_image'] = "";
	    db::table('tbl_blogs')->insert($array_blog_new);
	    return Redirect::to('all-blog');
	    //$array_blog_new['blog_image'] = $request->blog_image;
    }
    /*end: public function index()*/

    /*begin: dell blog*/
    public function dell(Request $request)
    {	
	   
    }
    /*end: public function index()*/
}
