@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách hình ảnh about
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Hình ảnh</th>
            <th>Hiển thị/Ẩn</th>
            <th>Tuỳ chọn</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($array_image as $key => $row)
          <tr>
            <td><img src="public/uploads/{{$row->image}}" width = "300px" height="300px" style="object-fit: cover;"></td>
            <td>
              <?php
                if($row->id == 1)
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
              <a href="{{URL::to('/edit-brand-product/'.$row->id)}}" ui-toggle-class="">
                <i class="fa fa-check text-success text-active">Sửa</i>
              </a>
              <a onclick="return confirm('Bạn thật sự muốn xoá?')" href="{{URL::to('/del-brand-product/'.$row->id)}}">
                <i class="fa fa-times text-danger text">Xoá</i>
              </a>
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
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection