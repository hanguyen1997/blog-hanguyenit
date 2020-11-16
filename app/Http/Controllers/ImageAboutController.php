<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class ImageAboutController extends Controller
{
	/*check user*/
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if($user_id == "") return Redirect::to('/admin')->send();
    }

	public function index()
    {
    	/*Kiểm tra đăng nhập*/
		$this->AuthLogin();

    	$array_image = DB::table('tbl_about')->orderBy("id","DESC")->get();

        if($array_image == null)
        {
            echo "<tr><td colspan='3' style='text-align: center;>Không có dữ liệu</td></tr>";
        }
        else
        {
    	// return view('admin.image_about.all_image_about')->with("array_image", $array_image);
            foreach ($array_image as $key => $value) {
                $content = "<tr>
                                <td>
                                <img src='public/uploads/".$value->image."'style='width:300px !important; height:300px !important;object-fit: cover;'>
                                </td>
                                <td style='font-size: 30px;'>";
                if($value->status == 1)
                { 
                    $content .= "<a id='active' data-id='".$value->id."'  data-status='".$value->status."'><i class='fa fa-thumbs-up'></i></a";
                }else
                { 
                   $content .=  "<a id='active' data-id='".$value->id."' data-status='".$value->status."'><i class='fa fa-thumbs-o-down' ></i></a";
                } 
                $content .= "</td>
                              <td>
                                <button data-id='".$value->id."' style='color: red;' id='button_del_image' name='button_del_image'>Xoá
                                </button>
                                </td>
                            </tr>";
               
                echo $content;
            }
            /*end: foreach ($array_image as $key => $value) */
        }
        /*end: if($array_image == null)*/
    }
    /*end: function index()*/

    /*save image about in about page home*/
    public function save_image(Request $request)
    {
    	/*Kiểm tra đăng nhập*/
		$this->AuthLogin();

    	$get_image = $request->file('image_about');
		$get_name_image = $get_image->getClientOriginalName();

		/*Hàm current lấy thâm số đầu sau dấu chấm của ảnh*/
		$name_image = current(explode(".", $get_name_image));
		$new_image = $name_image.rand(0,99).".".$get_image->getClientOriginalExtension();
		$get_image->move('public/uploads', $new_image);

		$array_about['image'] = $new_image;
		$array_about['type'] = "image";
		$array_about['content'] = "";
		$array_about['status'] = "1";

		DB::table('tbl_about')->insert($array_about);
		return Redirect::to('all-image-about');
    }
    /*end: public function save_image(Request $require)*/

    /*del img*/
    public function del(Request $request)
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();
        $id = $request->id;

        DB::table('tbl_about')->where('id', $id)->delete();
        echo "done";
    }
    /*end: public function del($id)*/

    /*begin: un active or active image in about page home*/
    public function active_or_unactive_image_about(Request $request)
    {
    	/*Kiểm tra đăng nhập*/
        $this->AuthLogin();

        $id = $request->id;
        /*truy vấn dữ liệu để lấy thông tin hình ảnh theo id*/
       	$array_image_about = DB::table('tbl_about')->where("id", $id)->first();

        /*kiểm tra id có tồn tại không*/
       	if($array_image_about != NULL)
       	{
            /*lấy trạng thái status*/
	       	$status_image = $array_image_about->status;

	       	/*Nếu đã active thì unactive nếu chưa thì active*/
	       	$array_update_image = array();
	       	if($status_image == "2") $array_update_image['status'] = "1";
			if($status_image == "1") $array_update_image['status'] = "2";
			
            /*Lưu lại và đặt thông báo chuyển trang danh sách hình ảnh thông tin ở trang chủ*/
			DB::table('tbl_about')->where("id", $id)->update($array_update_image);
	        echo "done";
            return;

    	}
    	/*end: if($array_image_about != NULL)*/

    	Session::put('message', 'Chỉnh sửa thất bại');
    	return Redirect::to('all-image-about');
    }
    /*end: function active_or_unactive_image_about($id)*/
}