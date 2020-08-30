<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false; //set times to false

    protected $filltable =['blog_code','blog_title','blog_keyword','blog_description','blog_content', 'blog_image','blog_status','created_at','id_user_create', 'viewcount'];
    protected $primaryKey = 'id_blog';
    protected $table = 'tbl_blogs';

    /*Liên kết 1-1 với bảng user, tbl_blog.id_user_create = tbl_user.user_id*/
    public function user(){
    	return $this->belongsTo('App\User', 'id_user_create', 'user_id');
    }
}
