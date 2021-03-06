<?php
use Illuminate\Support\Facades\Route;
use App\UserGroup;
use App\User;

/*home*/
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
/*thông tin chi tiết*/
Route::get('/about', function(){
    return View('public.pages.about');
});

/*Liên hệ*/
Route::get('/contact', function(){
    return View('public.pages.contact');
});

/*blog*/
Route::get('/list-blog/', 'BlogController@list_blog');
Route::get('/detail-blog/{blog_code}', 'BlogController@detail_blog_public');

/*liên hệ*/
Route::post('/contact', 'HomeController@contact');

///////////////*begin : admin*/////////////////////////

Route::get('/admin', function () {
	$user_id = Session::get('user_id');
	if($user_id != "") return Redirect::to('/dashboard');
    else return View('admin.auth.admin_login');
    
});
Route::get('/logout', 'AdminController@logout');
Route::post('/check-login', 'AdminController@check_login');
Route::get('/dashboard', 'AdminController@dashboard');

/*blogs*/
Route::get('/all-blog', 'BlogController@index');
Route::get('/add-blog', function () {
	/*Kiểm tra đăng nhập*/
	$user_id = Session::get('user_id');
    if($user_id == "") return Redirect::to('/admin')->send();
    else return view('admin.Blogs.add_blog');
});
Route::post('/save-blog', 'BlogController@save');
Route::get('/detail-blog-admin/{id_blog}', 'BlogController@detail_blog_admin');
Route::get('/dell-blog-admin/{id_blog}', 'BlogController@dell');
Route::get('/form-edit-blog/{id_blog}', 'BlogController@form_edit');
Route::post('/update-blog/{id_blog}', 'BlogController@update_blog');
Route::post('/check-title', 'BlogController@check_title');

/*trang-danh-sach-image-about*/
Route::get('/all-image-about',  function () {
    /*Kiểm tra đăng nhập*/
    $user_id = Session::get('user_id');
    if($user_id == "") return Redirect::to('/admin')->send();
    else return view('admin.image_about.all_image_about');
});
Route::get('/all-image-about-ajax',  'ImageAboutController@index');
Route::post('/save-image-about', 'ImageAboutController@save_image');
Route::get('/del-image-about', 'ImageAboutController@del');
Route::get('/active-image-about', 'ImageAboutController@active_or_unactive_image_about');
Route::get('/add-image-about', function () {
    /*kiểm tra đăng nhập*/
    $user_id = Session::get('user_id');
    if($user_id == "") return Redirect::to('/admin')->send();
    else return view('admin.image_about.add_image_about');
});


/*contact*/
Route::get('/ajax-list-contact', 'ContactController@index');
Route::get('/list-contact', function(){
    return View('admin.contacts.index');
});
Route::get('/dell-contact', 'ContactController@ajax_del');


/*User*/
Route::get('/list-user', 'UserController@index');
Route::get('/form-add-user', function(){
    $user_id = Session::get('user_id');
    $user_group_id = Session::get('user_group_id');
    if($user_id == "") return Redirect::to('/admin')->send();
    if($user_group_id != "1") return Redirect::to('/admin')->send();
    $array_user_group = UserGroup::orderBy("id_user_group", "DESC")->get();
    return View('admin.user.add')->with("array_user_group", $array_user_group);
});
Route::post('/save-user', 'UserController@save');
Route::get('/ajax-check-email-user', 'UserController@check_email_user');
Route::get('/del-user/{user_id}', 'UserController@delete');
Route::get('/detail-user/{user_id}', 'UserController@detail');
Route::post('/edit-user/{user_id}', 'UserController@edit');
Route::get('/change-password-user/{user_id}', function($user_id){
    
    /*Kiểm tra đăng nhập và kiểm tra phải admin không*/
    $user_id_session = Session::get('user_id');
    if($user_id_session == "") return Redirect::to('/admin')->send();

    /*Nếu là admin thì có thể thay đổi pass theo uid truyền lên*/
    $user_group_id = Session::get('user_group_id');
    if($user_group_id == "1")   $array_user = User::where("user_id", $user_id)->get();
    
    /*ngược lại thì chỉ có thể thay đổi mk của chính user đó */
    else $array_user = User::where("user_id", $user_id_session)->get();

    
    return View('admin.user.change_password')->with("array_user", $array_user);

});
Route::post('/change-password/{user_id}', 'UserController@change_password');
Route::get('/form-edit-user/{user_id}', function($user_id){
    
    /*Kiểm tra đăng nhập và kiểm tra phải admin không*/
    $user_id_session = Session::get('user_id');
    $user_group_id = Session::get('user_group_id');
    if($user_id_session == "") return Redirect::to('/admin')->send();

    /*truy vấn nhóm user*/
    $array_group_user = UserGroup::all();

    /*Nếu là admin thì có quyền sửa đc tất cả, còn user không có quyền sửa người khác*/
    if($user_group_id != "1" ) $array_user = User::where("user_id", $user_id_session)->get();
    else $array_user = User::where("user_id", $user_id)->get();
    
    return View('admin.user.edit')->with("array_user", $array_user)->with("array_group_user", $array_group_user);

});


/*User group*/
Route::get('/list-user-group', function(){
    /*kiểm tra đăng nhập*/
    $user_id = Session::get('user_id');
    $user_group_id = Session::get('user_group_id');
    if(($user_id == "") && ($user_group_id  != "1")) return Redirect::to('/admin')->send();

    return view('admin.user_group.index');
});
Route::get('/index-user-group-name', 'UserGroupController@index');
Route::get('/check-user-group-name', 'UserGroupController@check_name_user_group');
Route::get('/del-user-group-name', 'UserGroupController@del_name_user_group');
Route::get('/save-user-group', 'UserGroupController@save_user_group');
Route::get('/edit-user-group', 'UserGroupController@eidt_user_group');
