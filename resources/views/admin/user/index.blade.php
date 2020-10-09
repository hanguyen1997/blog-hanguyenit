@extends('admin.layouts.admin_layout')

@section('content')
<style type="text/css">
  a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;
 
    text-decoration: none;
    color: initial;
  }
  thead tr th{
    text-align: center;
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
      Danh sách người dùng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" style="text-align: center;">
        <thead>
          <tr>
            <th>Họ và tên</th>
            <th>Gmail</th>
            <th>Nhóm người dùng</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tbody class ="ajax-data" >
          @foreach($array_user as $key => $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>

            <?php 
              /*check user_group_name != ""*/
              if(isset($user->user_group->user_group_name) != NULL)  echo "<td>{$user->user_group->user_group_name}</td>";
              else echo "<td>Nhóm này chưa xác định hoặc đã xoá </td>";
            ?>
          
            <td>
            <button style='background:red;'>
              <a style='color:white' id="delete_user" type="button" href="{{URL('del-user/'.$user->user_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xoá</a>
            </button>
            <button  style='background:#6464f3;'>
              <a style='color:white' href="{{URL('detail_user')}}" >Chi tiết</a>
            </button>
            <button  style='background:#57a957;'>
              <a style='color:white' href='#' data-id='".$user->id."'>Đổi mật khẩu</a>
            </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection