@extends('admin.layouts.admin_layout')

@section('content')
<style type="text/css">
  .img_user{
    border-radius: 50%;
    background-color: #CCC;
    height: 250px;
    width: 250px;
    overflow: hidden;
    margin: 0px auto 20px auto;
  }
  .img_user img{
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .panel{
    text-align: center;
  }
  .form-user text{
    font-weight: 400;
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

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người dùng
    </div>
    <div class="row">
      <div class="col-lg-12">
        @foreach ($array_user as $key => $user)
          <section class="panel">
              <div class="panel-body">
                <div class="form-user">
                  <div class="img_user">
                    <img src="{{asset('public/backend/images/'.$user->image)}}">
                  </div>
                </div>
                <div class="form-user">
                  <label for="exampleInputEmail1">Họ và tên : <text>{{$user->name}}</text></label>
                </div>
                <div class="form-user">
                  <label for="exampleInputEmail1">Email : <text>{{$user->email}}</text></label>
                </div>
                 <div class="form-user">
                  <label for="exampleInputEmail1">Số điện thoại : <text>{{$user->phone}}</text></label>
                </div>
                <div class="form-user"> 
                  <?php 
                    if($user['sex'] == "1") $sex = "Nam";
                    if($user['sex'] == "0") $sex = "Nữ";
                  ?>
                  <label for="exampleInputPassword1">Giới tính : <text><?php echo $sex; ?></text></label>
                  
                </div>
                <div class="form-user"> 
                  <label for="exampleInputPassword1">Nhóm thành viên : <text>{{$user->user_group->user_group_name}}</text></label>
                </div>
                <a href="{{URL('/form-edit-user/'.$user->user_id)}}">Chỉnh sửa thông tin</a>
              </div>
          </section>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection