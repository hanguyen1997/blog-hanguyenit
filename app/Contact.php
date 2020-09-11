<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $filltable = ['user_name','email','message'];
    protected $primarykey = "id_contact";
    protected $table = "tbl_contact";
}