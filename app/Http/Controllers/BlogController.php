<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogController extends Controller
{
	/*check user, */
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();
    }
    /*end: public function AuthLogin()*/

	/*begin: list all post blog*/
    public function index()
    {	
    	/*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	$array_blog = DB::table('tbl_blogs')->where("blog_status", "<>" , "3")->get();

    	return view('admin.blogs.all_blog')->with(compact('array_blog'));
    }
    /*end: public function index()*/

    /*begin: save post blog new*/
    public function save(Request $request)
    {	
    	/*Kiểm tra đăng nhập*/
    	$this->AuthLogin();
    	
	    $array_blog_new = array();
	    $array_blog_new['blog_title'] = $request->blog_title;
	    $array_blog_new['blog_code'] = $request->blog_code;
	    $array_blog_new['blog_description'] = $request->blog_description;
        $array_blog_new['blog_content'] = $request->blog_content;
	    $array_blog_new['blog_keyword'] = $request->blog_keyword;
        $array_blog_new['blog_status'] = $request->blog_status;
	    $array_blog_new['created_at'] = date("Y-m-d H:i:s"); 
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
    /*end: function save(Request $request)*/

    /*begin: dell blog. Chuyển trạng thái sang 3*/
    public function dell($id_blog)
    {	
	   /*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	$array_blog_new['blog_status'] = "3";
    	Db::table('tbl_blogs')->where("id_blog", $id_blog)->update($array_blog_new);

		Session::put('message','Xoá thành công');
    	return Redirect('all-blog');
    }
    /*end: function dell($id_blog)*/

    /*begin: detail blog in admin*/
    public function detail_blog_admin($id_blog)
    {	
	   /*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	/*Lấy thông tin chi tiết blog bằng id_blog*/
    	$array_blog = Db::table('tbl_blogs')->where("id_blog", $id_blog)->get();

    	return View('admin.blogs.detail_blog')->with("array_blog", $array_blog);
    }
    /*end: function detail_blog_admin($id_blog)*/


    /*begin: cerate form edit blog*/
    public function form_edit($id_blog)
    {	
	   /*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	/*Lấy thông tin chi tiết blog bằng id_blog*/
    	$array_blog_edit = Db::table('tbl_blogs')->where("id_blog", $id_blog)->first();

    	return View('admin.blogs.edit_blog')->with("array_blog_edit", $array_blog_edit);
    }
    /*end: function detail_blog_admin($id_blog)*/

//////////////////////////////////*PUBLIC*//////////////////////////////////
    
    /*begin: list blog*/
    public function list_blog()
    {   
        $array_blog = Db::table('tbl_blogs')->where("blog_status", "1")->orderBy("id_blog", "DESC")->get();

        return View('public.pages.list_blog')->with("array_blog", $array_blog);
    }
    /*end: function list_blog()*/
    

    public function detail_blog_public($blog_code)
    {
        $array_detail_blog = Db::table('tbl_blogs')->where("blog_code", $blog_code)->get();

        foreach($array_detail_blog as $value)
        {
            $blog_title = $value->blog_title;
            $blog_keyword = $value->blog_keyword;
            $blog_description = $value->blog_description;
        }

        return View('public.pages.detail_blog')->with(compact('array_detail_blog','blog_title','blog_keyword','blog_description'));
    }
    /*end: function detail_blog_public()*/
}
