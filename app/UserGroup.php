<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $filltable = ["user_group_name"];
    protected $primarykey = "id_user_group";
    protected $table = "tbl_user_groups";

    /*Liên kết 1-1 bằng phương thức hasOne khoá chính đến khoá ngoại bảng tbl_users*/
    function user(){
    	return $this->hasOne("App\User","id_user_group","user_group_id");
    }
    /*end function User()*/
}