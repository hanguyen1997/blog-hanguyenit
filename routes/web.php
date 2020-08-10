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
Route::get('/form-login', function () {
    return view('admin_login');
});
Route::get('/logout', 'AdminController@logout');
Route::POST('/check-login', 'AdminController@check_login');
Route::get('/dashboard', 'AdminController@dashboard');

/*blogs*/
Route::get('/all-blog', 'BlogController@index');
Route::get('/add-blog', function () {
    return view('admin.Blogs.add_blog');
});
Route::post('/save-blog', 'BlogController@save');

/*image-about*/
Route::get('/all-image-about', 'ImageAboutController@index');
Route::post('/save-image-about', 'ImageAboutController@save_image');
Route::get('/del-image-about/{id}', 'ImageAboutController@del');
Route::get('/add-image-about', function () {
    return view('admin.image_about.add_image_about');
});
