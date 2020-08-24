@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
  #image_name img{
    width: 70%;
    height: auto;
    object-fit: unset;
  }
</style>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm hình ảnh giới thiệu trang chủ
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form id="form_save_image_about" role="form" action="{{URL::to('/save-image-about')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hình ảnh tiêu đề</label>
                        <input type="file" name="image_about" class="form-control" id="image_about" onchange="show_image()">
                        <div  id="image_name"></div>
                    </div>
                    <button onclick="checkform()" type="button" name="add_category_product" class="btn btn-info">Thêm hình ảnh mới</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>
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
        <tbody id="all_image_about">
          
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
<script type="text/javascript">
$(document).ready(function(){

  /*dùng ajax để hiện thị danh sách*/
  function fetch_data(){
    $.ajax({
      method: 'get',
      url: "{{URL('/all-image-about-ajax')}}",
      success:function(data){
        $('#all_image_about').html(data);
      }
    })
  }
  /*end: function fetch_data()*/

  fetch_data();

  /*Hiển thị hoặc ẩn hình ảnh bên ngoài*/
  $(document).on('click','#active',function(){
    /*Lấy id_contact*/
    var id = $(this).data('id');
    var status = $(this).data('status');
    /*nếu status = 1 thì hiển thị thông báo unactive và 2 thì ngược lại*/
    if(status = "1")
    {
      /*Hiển thị thông báo xác nhận xoá*/
      swal({
        title: "Bạn có muốn ẩn hình ảnh này bên ngoài không ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete)
        {
          /*Nếu đồng ý thì xoá dữ liệu bằng ajax*/
          $.ajax({
            method: "GET",
            url: "{{URL('/active-image-about')}}",
            data:{id:id},
            success:function(data){
              if(data == "done")
              {
                /*gọi hàm làm mới lại danh sách và thông báo xoá thành công*/
                fetch_data();
                swal("Thành công", {icon: "success",});
              }
            }
          })
        }
      });
    }
    else
    {
      /*Hiển thị thông báo xác nhận xoá*/
      swal({
        title: "Bạn có muốn hiển thị hình ảnh này ra bên ngoài không ?",
        text: "Hình ảnh sẽ được hiển thị ở trang chủ phần thông tin about",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete)
        {
          /*Nếu đồng ý thì xoá dữ liệu bằng ajax*/
          $.ajax({
            method: "GET",
            url: "{{URL('/active-image-about')}}",
            data:{id:id},
            success:function(data){
              if(data == "done")
              {
                /*gọi hàm làm mới lại danh sách và thông báo xoá thành công*/
                fetch_data();
                swal("Thành công", {icon: "success",});
              }
            }
          })
        }
      });
    }
  })
  /*end: $(document).on('click','#active',function()*/

  /*Xoá hình ảnh bằng ajax*/
  $(document).on('click','#button_del_image',function(){
    /*Lấy id_contact*/
    var id = $(this).data('id');

    /*Hiển thị thông báo xác nhận xoá*/
    swal({
      title: "Bạn có muốn xoá hình ảnh này không ?",
      text: "Nếu đã xoá thì sẽ không khôi phục được, vui lòng suy nghĩ kĩ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if(willDelete)
      {
        /*Nếu đồng ý thì xoá dữ liệu bằng ajax*/
        $.ajax({
          method: "GET",
          url: "{{URL('/del-image-about')}}",
          data:{id:id},
          success:function(data){
            if(data == "done")
            {
              /*gọi hàm làm mới lại danh sách và thông báo xoá thành công*/
              fetch_data();
              swal("Thành công", {icon: "success",});
            }
          }
        })
      }
    });
  })
})
/*end:  $(document).on('click','#button_del_image',function()*/

/*Hiển thị ảnh trước khi upload lên sever*/ 
function show_image(){
  /*Lấy tên file*/
  var imageSelected = document.getElementById('image_about').files;

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

/*Kiểm tra form*/ 
function checkform(){
  /*Kiểm tra truyền hình ảnh lên không*/
  if(document.getElementById("image_about").value == "" )
  {
      swal("Gặp lỗi rồi !!!", "Vui lòng chọn hình ảnh muốn tải lên");
      return;
  }
  document.getElementById("form_save_image_about").submit();
}
/*end: function checkform()*/

</script>
@endsection