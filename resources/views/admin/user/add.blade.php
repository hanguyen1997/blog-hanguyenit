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
                Thêm thành viên mới
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form id="form_add_user" role="form" action="{{URL::to('/save-user')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên (*)</label>
                        <input type="text" name="user_name" class="form-control" id="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email (*)</label>
                        <input type="email" name="user_email" class="form-control" id="user_email" pattern=".+@globex.com" size="30" required >
                        <div id="confim_email_user"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu (*)</label>
                        <input type="password" name="user_password" class="form-control" id="user_password" >
                        <div id="confim_password_user"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Xác thực mật khẩu (*)</label>
                        <input type="password" name="check_user_password" class="form-control" id="check_user_password" >
                        <div id="confim_check_password_user"></div>
                    </div>
                    <div class="form-group"> 
                        <label for="exampleInputPassword1">Giới tính</label>
                        <select name="user_sex" class="form-control input-sm m-bot15">
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group"> 
                        <label for="exampleInputPassword1">Nhóm thành viên</label>
                        <select name="user_group_id" class="form-control input-sm m-bot15">
                            @foreach($array_user_group as $row)
                                <option value="{{$row->id_user_group}}">{{$row->user_group_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" onclick="checkform()" name="add_user" class="btn btn-info">Thêm thành viên mới</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        /*Kiểm tra email đã tồn tại chưa*/
        $("#user_email").blur(function(){
            var user_email = document.getElementById('user_email').value;

            /*Nếu ô email có dữ liệu */
            if(user_email != "")
            {
                /*Kiểm tra email có hợp lệ khôn*/
                var atposition = user_email.indexOf("@");
                var dotposition = user_email.lastIndexOf(".");
                if (atposition < 1 || dotposition < (atposition + 2)
                        || (dotposition + 2) >= user_email.length) {
                    $("#confim_email_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Email này không hợp lệ</span>");
                    document.getElementById("user_email").focus();
                    return;
                }
               
                /*gửi dữ liệu ajax kiểm tra email đã tồn tại chưa và in thông báo*/
                $.ajax({
                    method:"GET",
                    url:"{{URL('/ajax-check-email-user')}}",
                    data:{user_email:user_email},
                    success:function(data){
                        if(data == "oke") $("#confim_email_user").html("<span class='oke'><i class='fa fa-check'></i> Email này có thể sữ dụng</span>");
                        else 
                        {
                            $("#confim_email_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Email này đã được sữ dụng, Hãy thử email khác</span>");
                            document.getElementById("user_email").focus();
                            return;
                        }
                        /*end: if(data == "oke")*/
                    }
                })
                /*end: ajax*/
            }
            else 
            {
                /*nếu không dữ liệu ô nhập email có thì xoá thông báo*/
                $("#confim_email_user").html("");
            }
            /*end: if(user_email != "")*/
        })

        /*kiểm tra mật khẩu */
        $("#user_password").blur(function(){
            var user_password = document.getElementById('user_password').value;
            if(user_password != "")
            {
                /*kiểm tra mật khẩu phải hơn 8 kí tự ,không quá 50 kí tự và có số và chữ không có kí tự đăc biệt*/
                if (user_password.length < 8) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu quá ngắn</span>");
                    document.getElementById("user_password").focus();
                } else if (user_password.length > 50) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu quá dài</span>");
                    document.getElementById("user_password").focus();
                } else if (user_password.search(/\d/) == -1 || user_password.search(/[a-zA-Z]/) == -1) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu cần có chữ và số</span>"); 
                    document.getElementById("user_password").focus();
                } else if (user_password.search(/[^a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+]/) != -1) { 
                    $("#confim_password_user").html("<span class='not_oke'><i class='fa fa-exclamation' ></i> Mật khẩu chứa kí tự đặc biệt</span>");
                    document.getElementById("user_password").focus();
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
        $("#check_user_password").blur(function(){
            var check_user_password = document.getElementById('check_user_password').value;
            var user_password = document.getElementById('user_password').value;
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

    /*begin: check form*/
    function checkform(){
        if(document.getElementById("user_name").value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập họ và tên ");
            return;
        }
        if(document.getElementById("user_email").value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập email");
            return;
        }

        /*kiểm tra email hợp lệ khôn*/
        if(document.getElementById("user_email").value != "")
        {
            var x = document.getElementById("user_email").value;
            var atposition = x.indexOf("@");
            var dotposition = x.lastIndexOf(".");
            if (atposition < 1 || dotposition < (atposition + 2)
                    || (dotposition + 2) >= x.length) {
                swal("Gặp lỗi rồi !!!", "Email không hợp lệ");
                return;
            }
        }
        if(document.getElementById("user_password").value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập mật khẩu");
            return;
        }
        if(document.getElementById("check_user_password").value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập xác thực mật khẩu");
            return;
        }
        if(document.getElementById("user_password").value != document.getElementById("check_user_password").value)
        {
            swal("Gặp lỗi rồi !!!", "Mật khẩu và mật khẩu xác thực không chính xác");
            return;
        }

        document.getElementById("form_add_user").submit();
    }
    /*end:  function checkform()*/

</script>
@endsection