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
    #image_name{
        border-radius: 50%;
        background-color: #CCC;
        height: 250px;
        width: 250px;
        overflow: hidden;
        margin: 0px auto 20px auto;
    }
    #image_name img{
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                Chỉnh sửa thành viên
            </header>
            @foreach($array_user as $key => $user)
            <div class="panel-body">
                <div class="position-center">
                    <form id="form_edit_user" role="form" action="{{URL::to('/edit-user/'.$user->user_id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label style="width: 100%;">
                             <div  id="image_name">
                                <img src="{{asset('public/backend/images/'.$user->image)}}">
                            </div>
                             <input type="file" name="image" class="form-control" id="image" onchange="show_image()" style="visibility: hidden;">
                            <!-- <input type="file" /> -->
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email : <text>{{$user->email}}</text></label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên (*)</label>
                        <input type="text" name="user_name" class="form-control" id="user_name" required value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại (*)</label>
                        <input type="text" name="user_phone" class="form-control" id="user_phone" required value="{{$user->phone}}">
                    </div>
                    <div class="form-group"> 
                        <label for="exampleInputPassword1">Giới tính</label>
                        <select name="user_sex" class="form-control input-sm m-bot15">

                            <option value="1" <?php if($user['sex'] == "1") echo "selected"; ?>>Nam</option>
                            <option value="0" <?php if($user['sex'] == "0") echo "selected"; ?>>Nữ</option>
                        </select>
                    </div>

                   
                    @if(Session::get('user_group_id') == "1")
                        <!-- Nếu là admin có thể chỉnh sủa quyền của user -->
                        <div class="form-group"> 
                        <label for="exampleInputPassword1">Nhóm thành viên</label>
                        <select name="id_user_group" class="form-control input-sm m-bot15">
                            @foreach($array_group_user as $key => $user_group)
                                <option value="{{$user_group->id_user_group}}" <?php if($user['user_group_id'] == $user_group->id_user_group) echo "selected"; ?>>{{$user_group->user_group_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    @endif
                    <button style="margin: 0 auto;display: flex;"type="button" onclick="checkform()" name="add_user" class="btn btn-info">Chỉnh sửa thành viên</button>
                </form>
                </div>
            </div>
            @endforeach
        </section>
    </div>
</div>
<script type="text/javascript">

    /*begin: check form*/
    function checkform(){
        if(document.getElementById("user_name").value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập họ và tên ");
            return;
        }
        if(document.getElementById("user_phone").value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập họ số điện thoại");
            return;
        }

        /*thông báo chắc chắn muốn sửa*/
        swal({
          title: "Bạn chắc chắn muốn thay đổi thông tin cá nhân không ?",
          text: "Sau khi chỉnh sửa, bạn sẽ không thể khôi phục lại như thông tin cũ!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) document.getElementById("form_edit_user").submit();
          else swal("Mọi thông tin đều không thay đổi!");
        });

        
    }
    /*end:  function checkform()*/

    /*Hiển thị ảnh trước khi upload lên sever*/ 
    function show_image(){
      /*Lấy tên file*/
      var imageSelected = document.getElementById('image').files;

      /*kiểm tra file khác rỗng*/
      if (imageSelected.length > 0) {
          var imageToLoad = imageSelected[0];
          var imageReader = new FileReader();
          imageReader.onload = function(fileLoaderEvent) {
              /*đường dẫn file khiw chưa lưu trên máy*/
              var srcData = fileLoaderEvent.target.result;
              var newImage = document.createElement('img');
              newImage.src = srcData;
              document.getElementById('image_name').innerHTML = newImage.outerHTML;
          }
          imageReader.readAsDataURL(imageToLoad);
      }
    }
    /*end: function show_image()*/

</script>
@endsection
