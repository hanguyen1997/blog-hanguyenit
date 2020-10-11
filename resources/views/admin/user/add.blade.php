@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    #confim_email_user{
        font-size: 12px;
        margin: 5px;
    }
    .email_not_oke{
        color: #e52c20;
    }
    .email_oke{
        color: #9b9bff;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thành viên mới
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form id="form_add_blog" role="form" action="{{URL::to('/save-user')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên:</label>
                        <input type="text" name="user_name" class="form-control" id="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email của bạn" data-rule="email" data-msg="Please enter a valid email" >
                        <div id="confim_email_user"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" name="user_password" class="form-control" id="user_password" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Xác thực mật khẩu</label>
                        <input type="password" name="check_user_password" class="form-control" id="check_user_password" >
                    </div>
                    <div class="form-group"> 
                        <label for="exampleInputPassword1">Giới tính</label>
                        <select name="user_sex" class="form-control input-sm m-bot15">
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                    <button type="button" onclick="checkform()" name="add_category_product" class="btn btn-info">Thêm Bài viết mới</button>
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

            /*Nếu ô email có dữ liệu thì gửi dữ liệu ajax kiểm tra và in thông báo*/
            if(user_email != "")
            {
                $.ajax({
                    method:"GET",
                    url:"{{URL('/ajax-check-email-user')}}",
                    data:{user_email:user_email},
                    success:function(data){
                        if(data == "oke") $("#confim_email_user").html("<span class='email_oke'><i class='fa fa-check'></i> Email này có thể sữ dụng</span>");
                        else $("#confim_email_user").html("<span class='email_not_oke'><i class='fa fa-exclamation' ></i> Email này đã được sữ dụng, Hãy thử email khác</span>");
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
    })

</script>
@endsection
