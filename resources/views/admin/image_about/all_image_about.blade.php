@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div style="font-size: 18px;" class="panel-heading">
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
            <td><img src="public/uploads/{{$row->image}}" style="width:300px !important; height:300px !important;object-fit: cover;"></td>
            <td>
              <?php
                if($row->status == 1)
                { ?>
                  <a href="{{URL::to('/active-image-about/'.$row->id)}}"><i class='fa fa-thumbs-up' ></i></a>
                <?php }else
                { ?>
                  <a href="{{URL::to('/active-image-about/'.$row->id)}}" ><i class='fa fa-thumbs-o-up' ></i></a>
                <?php } 
              ?>
            </td>
            <td>
              <a onclick="return confirm('Bạn thật sự muốn xoá?')" href="{{URL::to('/del-image-about/'.$row->id)}}">
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