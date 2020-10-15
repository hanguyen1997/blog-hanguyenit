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
  .panel{
    text-align: center;
  }
  .form-user text{
    font-weight: 400;
  }
</style>
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
                    <img src="public/uploads/">
                  </div>
                </div>
                <div class="form-user">
                  <label for="exampleInputEmail1">Họ và tên : <text>{{$user->name}}</text></label>
                </div>
                <div class="form-user">
                  <label for="exampleInputEmail1">Email : <text>{{$user->email}}</text></label>
                  
                </div>
                <div class="form-user"> 
                  <?php 
                    if($user->sex == "0") $sex = "Nam";
                    if($user->sex == "1") $sex = "Nữ";
                  ?>
                  <label for="exampleInputPassword1">Giới tính : <text><?php echo $sex; ?></text></label>
                  
                </div>
                <div class="form-user"> 
                  <label for="exampleInputPassword1">Nhóm thành viên : <text>{{$user->user_group->user_group_name}}</text></label>
                </div>
                <a href="#">Chỉnh sửa thông tin</a>
              </div>
          </section>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection