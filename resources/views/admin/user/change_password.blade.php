@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    #confim_email_user{
        font-size: 12px;
        margin: 5px;
    }
    #confim_password_user{
        font-size: 12px;
        margin: 5px;
    }
    #confim_check_password_user{
        font-size: 12px;
        margin: 5px;
    }
    .not_oke{
        color: #e52c20;
    }
    .oke{
        color: #9b9bff;
    }
</style>
<div>
  <?php
    /*Nếu có thông báo thì hiển thị*/
    $message = Session::get("message");
    if($message)
    {
      echo "<div style='text-align: center;font-size: 15px;color: #5050f0;' class='alert alert-info'>$message</div>";
      Session::put("message", NULL);
    }
    /*end: if($message)*/
  ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thay đổi mật khẩu
            </header>
            <div class="panel-body">
                <div class="position-center">
                    @foreach($array_user as $key => $user)
                    <form id="form_change_password_user" role="form" action="{{URL::to('/change-password/'.$user->user_id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gmail </label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên </label>
                        <p>{{ $user->name }}</p>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu mới (*)</label>
                        <input type="password" name="user_password_new" class="form-control" id="user_password_new" >
                        <div id="confim_password_user"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Xác thực mật khẩu (*)</label>
                        <input type="password" name="check_user_password_new" class="form-control" id="check_user_password_new" >
                        <div id="confim_check_password_user"></div>
                    </div>
                    <button type="button" onclick="checkform()" name="add_user" class="btn btn-info">Thay đổi mật khẩu</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
         /*kiểm tra mật khẩu */
        $("#user_password_new").blur(function(){
            var user_password = document.getElementById('user_password_new').value;
            if(user_password != "")
            {
                /*kiểm tra mật khẩu phải hơn 8 kí tự ,không quá 50 kí tự và có số và chữ không có kí tự đăc biệt*/
                if (user_password.length < 8) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu quá ngắn</span>");
                    document.getElementById("user_password_new").focus();
                } else if (user_password.length > 50) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu quá dài</span>");
                    document.getElementById("user_password_new").focus();
                } else if (user_password.search(/\d/) == -1 || user_password.search(/[a-zA-Z]/) == -1) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu cần có chữ và số</span>"); 
                    document.getElementById("user_password_new").focus();
                } else if (user_password.search(/[^a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+]/) != -1) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu chứa kí tự đặc biệt</span>");
                    document.getElementById("user_password_new").focus();
                }else{
                    $("#confim_password_user").html("<span class='oke'><i class='fa fa-check' ></i> Mật khẩu hợp lệ</span>");
                }
            }
            else 
            {
                $("#confim_password_user").html("");
            }
            /*end: if(user_password != "")*/
        })

        /*Kiểm tra xác thưc mật khẩu*/
        $("#check_user_password_new").blur(function(){
            var check_user_password = document.getElementById('check_user_password_new').value;
            var user_password = document.getElementById('user_password_new').value;
            if(check_user_password != "" && user_password != "")
            {
                if(check_user_password == user_password)
                {
                    $("#confim_check_password_user").html("<span class='oke'><i class='fa fa-check' ></i> Mật khẩu khớp</span>");
                }
                else{
                    $("#confim_check_password_user").html("<span class='not_oke'><i class='fa fa-exclamation'></i> Mật khẩu xác thực không khớp</span>");
                    document.getElementById("check_user_password").focus();
                }
                /*end: if(check_user_password == user_password)*/
            }
            else 
            {
                $("#confim_check_password_user").html("");
            }
            /*end: if(check_user_password != "")*/
        })

    })
    /*end $(document).ready(function()*/

    //kiem tra form
    function checkform(){
        if(document.getElementById('user_password_new').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập mật khẩu mới");
            return;
        }
        /*end: if(document.getElementById('user_password_new').value == "")*/

        if(document.getElementById('check_user_password_new').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập xác thực mật khẩu mới");
            return;
        }
        /*end: if(document.getElementById('check_user_password_new').value == "")*/

        if(document.getElementById('user_password_new').value != document.getElementById('check_user_password_new').value)
        {
            swal("Gặp lỗi rồi !!!", "Mật khẩu xác thực không khớp mật khẩu mới");
            return;
        }

        document.getElementById('form_change_password_user').submit();
    }
</script>
@endsection