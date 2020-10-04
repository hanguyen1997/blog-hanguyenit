<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Blog;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogController extends Controller
{
	/*check user */
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();
    }
    /*end: public function AuthLogin()*/

	/*begin: list all post blog in page admin*/
    public function index()
    {	
    	/*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

        /*(blogs_tatus =  3) -> dell*/
        $array_blog = Blog::where("blog_status" ,"<>","3")->paginate(10);
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
        $array_blog_new['viewcount'] = "0";

        /*Lấy id của người đăng bài*/
        $array_blog_new['id_user_create'] = Session::get('user_id');
	    
	    /*Kiểm tra có hình ảnh khong, nếu không có thì lưu rỗng*/
        $get_image = $request->file('blog_image');
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

    /*begin: dell blog */
    public function dell($id_blog)
    {	
	   /*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

        /*select * form tbl_blogs where id_blog = $id_blog*/
        $array_del_blog = Blog::find($id_blog);

        /*delete form tbl_blogs where id_blog = $id_blog*/
        $array_del_blog->delete();

        /*Đặt thông báo thành công và chuyển trang*/
		Session::put('message','Xoá thành công');
    	return Redirect('all-blog');
    }
    /*end: function dell($id_blog)*/

    /*begin: detail blog in page admin*/
    public function detail_blog_admin($id_blog)
    {	
	   /*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	/*Lấy thông tin chi tiết blog bằng id_blog*/
    	//$array_blog = Db::table('tbl_blogs')->where("id_blog", $id_blog)->get();
        $array_blog = Blog::where("id_blog",$id_blog)->get();
    	return View('admin.blogs.detail_blog')->with("array_blog", $array_blog);
    }
    /*end: function detail_blog_admin($id_blog)*/

    /*begin: cerate form edit blog*/
    public function form_edit($id_blog)
    {	
	   /*Kiểm tra đăng nhập*/
    	$this->AuthLogin();

    	/*Lấy thông tin chi tiết blog bằng id_blog*/
    	$array_blog_edit = Blog::find($id_blog);
    	return View('admin.blogs.edit_blog')->with("array_blog_edit", $array_blog_edit);
    }
    /*end: function detail_blog_admin($id_blog)*/

    /*begin: kiểm tra title blog có trùng không*/
    public function check_title(Request $request)
    {   
       /*Kiểm tra đăng nhập*/
        $this->AuthLogin();
        /*Lấy dữ liệu bằng request*/
        $blog_title = $request->blog_title;
        /*thực hiện câu truy vấn where blog-titile = $blog_title truyền lên trong model Blog*/
        $array_ckeck_title = Blog::where("blog_title",$blog_title)->first();

        /*Nếu có dữ liệu rồi thì exist, chưa thì check_ok*/
        if($array_ckeck_title != Null) echo "exist";
        if($array_ckeck_title == Null) echo "check_ok";
    }
    /*end: function check_title(Request $request)*/

    /*begin: update blog*/
    public function update_blog(Request $request, $id_blog)
    {   
       /*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        /*Lấy thông tin chi tiết blog bằng id_blog*/
        $array_blog_edit = Blog::find($id_blog);
        $array_blog_edit->blog_code = $request->blog_code;
        $array_blog_edit->blog_title = $request->blog_title;
        $array_blog_edit->blog_keyword = $request->blog_keyword;
        $array_blog_edit->blog_description = $request->blog_description;
        $array_blog_edit->blog_content = $request->blog_content;
        $array_blog_edit->created_at = date("Y-m-d H:i:s");
        $array_blog_edit->blog_status = $request->blog_status;
        
        $get_image = $request->file('blog_image');
        $get_name_image = $get_image->getClientOriginalName();

        /*Hàm current lấy thâm số đầu sau dấu chấm của ảnh*/
        $name_image = current(explode(".", $get_name_image));
        $new_image = $name_image.rand(0,99).".".$get_image->getClientOriginalExtension();
        $get_image->move('public/uploads', $new_image);
        $array_blog_edit->blog_image = $new_image;
        $array_blog_edit->save();
        
        Session::put('message','Thành công');
        return Redirect('/all-blog');
    }
    /*end: function detail_blog_admin($id_blog)*/

//////////////////////////////////*PUBLIC*//////////////////////////////////
    
    /*begin: list blog*/
    public function list_blog()
    {   
        /*blog_status = 1 -> hiển thị , blog_status = 2 -> ko hiển thị */
        $array_blog = Blog::where("blog_status", "1")->orderBy("id_blog", "DESC")->paginate(6);

        return View('public.pages.list_blog')->with("array_blog", $array_blog);
    }
    /*end: function list_blog()*/
    
    /*trang chi tiết blog*/
    public function detail_blog_public($blog_code)
    {
        $array_detail_blog = Blog::where("blog_code", $blog_code)->get();

         $array_more_blog = NULL;
        /*lấy dữ liệu chi tiết blog trong mảng $array_detail_blog*/
        foreach($array_detail_blog as $value)
        {
            $blog_title = $value->blog_title;
            $blog_keyword = $value->blog_keyword;
            $blog_description = $value->blog_description;
            $blog_image = $value->blog_image;
            $id_blog = $value->id_blog;

            /*Link đường dẩn ảnh <meta property="og:image" content="" /> share */
            $url_image = "http://localhost/blog-hanguyenit/public/uploads/".$blog_image;

            /*Lấy thêm 3 blog bất kỳ khác với blog đang hiện thị*/
            $array_more_blog = Blog::where("id_blog", "<>", $id_blog)->get();
        }
        /*end: foreach($array_detail_blog as $value)*/

        return View('public.pages.detail_blog')->with(compact('array_detail_blog','blog_title','blog_keyword','blog_description','url_image', 'array_more_blog'));
    }
    /*end: function detail_blog_public()*/
}