@extends('admin.layouts.admin_layout');
@section('content')
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
                    <img style="width: auto; height: 300px;" src="{{asset('public/uploads/'.$array_blog_edit->blog_image)}}"></img>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hình ảnh tiêu đề</label>
                        <input type="file" name="blog_image" class="form-control" id="blog_image" value="{!!$array_blog_edit->blog_image!!}">
                    </div>
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
    
    
</script>
@endsection