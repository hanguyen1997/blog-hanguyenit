@extends('admin.layouts.admin_layout')  
@section('content')
<style type="text/css">
    #image_blog img {
        width:100%;
    }
</style>
<section class="panel">
    <header class="panel-heading">
        Chỉnh sửa bài viết
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="{{URL::to('/update-blog/'.$array_blog_edit->id_blog)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Tiêu đề</label>
                <input type="text" name="blog_title" class="form-control" id="post_title" required  placeholder="Tiêu đề bài viết" value="{{$array_blog_edit->blog_title}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mã</label>
                <input type="text" name="blog_code" class="form-control" id="post_code" value="{{$array_blog_edit->blog_code}}">
            </div>
             <div class="form-group">
                <label style="width: 100%;">
                    <label for="exampleInputPassword1">Hình ảnh tiêu đề</label>
                    <div  id="image_blog">
                        <img  src="{{asset('public/uploads/'.$array_blog_edit->blog_image)}}">
                    </div>
                     <input type="file" name="image" class="form-control" id="image" onchange="show_image()" style="visibility: hidden;">
                    <!-- <input type="file" /> -->
                </label>
            </div>

           <!--  <div class="form-group">
                
                 <img style="width: auto; height: 300px;" src="{{asset('public/uploads/'.$array_blog_edit->blog_image)}}"></img>
                <input type="file" name="blog_image" class="form-control" id="blog_image" value="alo" onchange="show_image()">
            </div> -->
            <div class="form-group">
                <label for="exampleInputPassword1">Mô tả ngắn gọn</label>
                <textarea class="form-control" name="blog_description" id=""  required placeholder="Mô tả sản phẩm">{{$array_blog_edit->blog_description}}</textarea> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nội dung </label>
                <textarea class="form-control" name="blog_content" id="ckeditor"  required placeholder="Nội dung bài viêt">{!!$array_blog_edit->blog_content!!}</textarea> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Từ khoá seo</label>
                <textarea class="form-control" name="blog_keyword" id=""  required placeholder="Từ khoá seo">{{$array_blog_edit->blog_keyword}}</textarea> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hiện thị</label>
                <select name="blog_status" class="form-control input-sm m-bot15">
                    <option <?php if($array_blog_edit->blog_status == '1'){echo("selected");}?> value="1" >Hiển thị</option>
                    <option <?php if($array_blog_edit->blog_status == '0'){echo("selected");}?> value="0">Ẩn</option>
                </select>
            </div>
            <button type="submit" name="add_category_product" class="btn btn-info">Chỉnh sửa bài viết mới</button>
        </form>
        </div>
    </div>
</section>

<script language="javascript">

    /*Khi thay đổi tiêu đề bài viết thì cập nhật giá trị url_key*/
    $(document).ready(function()
    {
        $("#post_title").blur(function(){
            var str = (document.getElementById("post_title").value);
            str= str.toLowerCase();
            str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
            str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
            str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
            str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
            str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
            str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
            str= str.replace(/đ/g,"d");
            str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,"-");
            str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
            str= str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
            $("#post_code").val(str);
        })
    });
    
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
              document.getElementById('image_blog').innerHTML = newImage.outerHTML;
          }
          imageReader.readAsDataURL(imageToLoad);
      }
    }
    /*end: function show_image()*/
</script>
@endsection