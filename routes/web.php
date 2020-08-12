<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');

/*begin : admin*/
Route::get('/admin', function () {
	$user_id = Session::get('user_id');
	if($user_id != "") return Redirect::to('/dashboard');
    else return View('admin_login');
    
});
Route::get('/logout', 'AdminController@logout');
Route::POST('/check-login', 'AdminController@check_login');
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
Route::get('/dell-blog/{id_blog}', 'BlogController@dell');
Route::get('/edit-blog/{id_blog}', 'BlogController@form_edit');

/*image-about*/
Route::get('/all-image-about', 'ImageAboutController@index');
Route::post('/save-image-about', 'ImageAboutController@save_image');
Route::get('/del-image-about/{id}', 'ImageAboutController@del');
Route::get('/active-image-about/{id}', 'ImageAboutController@active_or_unactive_image_about');
Route::get('/add-image-about', function () {
    /*kiểm tra đăng nhập*/
    $user_id = Session::get('user_id');
    if($user_id == "") return Redirect::to('/admin')->send();
    else return view('admin.image_about.add_image_about');
});
