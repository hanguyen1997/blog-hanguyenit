<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $filltable = ['user_group_id','name','email','image','phone','sex','password'];
    protected $primaryKey = "user_id";
    protected $table = "tbl_users";

    /*Liên kết 1-1 khoá ngoại user_group_id đến khoá chính id_user_group trong bảng tbl_user_groups bằng phương thức beLongTo*/ 
    public function user_group(){
    	return $this->belongsTo("App\UserGroup","user_group_id","id_user_group");
    }
    /*end: public function user_group()*/
}
