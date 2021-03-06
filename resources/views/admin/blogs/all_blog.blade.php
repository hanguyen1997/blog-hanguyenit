@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
  .head_table tr th{
    text-align: center;
    border: solid #d2cece;
  }
  .body_table tr td{
    border: solid #d2cece;
  }
</style>
<?php
  /*Lấy Thông báo Session::get*/
  $message = Session::get('message');

  /*Kiểm tra nếu có thông báo thì hiển thị*/
  if(isset($message)) 
  {
    echo "<div style='text-align: center;font-size: 15px;color: #5050f0;' class='alert alert-info'>$message</div>";
    Session::put('message', NULL);
  }
?>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách blog
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Chọn</option>
          <option value="1">Ẩn</option>
          <option value="2">Hiện</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
    </div>
    <div class="table">
      <table style="width: 100%;">
        <thead class="head_table">
          <tr>
            <th>Tiêu đề</th>
            <th>Mã</th>
            <th>Mô tả</th>
            <th>Hiển thị/Ẩn</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tbody class="body_table">
          @foreach($array_blog as $key => $row)
          <tr>
            <td>{{$row->blog_title}}</td>
            <td>{{$row->blog_code}}</td>
            <td>{{$row->blog_description}}</td>
            <td>
              <?php
                if($row->blog_status == 1)
                {
                  echo "Hiện thị";
                }
                else
                {
                  echo "Ẩn";
                } 
              ?>
            </td>
            <td>
              <button class="button">
                <a href="{{URL::to('/detail-blog-admin/'.$row->id_blog)}}">
                  <i class="fa fa-asterisk text-primary text"> Chi tiết</i>
                </a>
              </button>
              <button class="button">
                <a href="{{URL::to('/form-edit-blog/'.$row->id_blog)}}" ui-toggle-class="">
                  <i class="fa fa-check text-success text-active">Sửa</i>
                </a>
              </button>
               <button class="button">
                <a onclick="return confirm('Bạn thật sự muốn xoá?')" href="{{URL::to('/dell-blog-admin/'.$row->id_blog)}}">
                  <i class="fa fa-times text-danger text">Xoá</i>
                </a>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {!! $array_blog->links(); !!}
        </div>
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function()
  {
    document.getElementById("menu-blogs").className = "dcjq-parent active";
    document.getElementById("list_blog").className = "active";

  })
</script>
@endsection