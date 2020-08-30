<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $filltable = ['user_group_id','name','email','password'];
    protected $primarykey = "user_id";
    protected $table = "tbl_users";
}
