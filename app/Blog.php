<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false; //set times to false

    protected $filltable =['blog_code','blog_title','blog_keyword','blog_description','blog_content', 'blog_image','blog_status','created_at','id_user_create', 'viewcount'];
    protected $primaryKey = 'id_blog';
    protected $table = 'tbl_blogs';
}
