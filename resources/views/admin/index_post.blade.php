@extends('admin_layout')
@section('content')
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
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tiêu đề</th>
            <th>Hình ảnh</th>
            <th>Mã</th>
            <th>Mô tả</th>
            <th>Nội dung</th>
            <th>Hiển thị/xoá</th>
            <th>Tuỳ chọn</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($array_post as $key => $row)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$row->post_title}}</td>
            <td>{{$row->post_title}}</td>
            <td>{{$row->post_code}}</td>
            <td>{{$row->post_description}}</td>
            <td>{{$row->post_content}}</td>
            <td>
              <?php
                if($row->post_status == 1)
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
              <a href="{{URL::to('/edit-brand-product/'.$row->id_post)}}" ui-toggle-class="">
                <i class="fa fa-check text-success text-active">Sửa</i>
              </a>
              <a onclick="return confirm('Bạn thật sự muốn xoá?')" href="{{URL::to('/del-brand-product/'.$row->id_post)}}">
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