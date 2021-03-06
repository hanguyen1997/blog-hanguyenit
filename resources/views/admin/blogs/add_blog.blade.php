@extends('admin.layouts.admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form id="form_add_blog" role="form" action="{{URL::to('/save-blog')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề</label>
                        <input type="text" name="blog_title" class="form-control" id="blog_title" required  placeholder="Tiêu đề bài viết">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã</label>
                        <input type="text" name="blog_code" class="form-control" id="blog_code" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hình ảnh tiêu đề</label>
                        <input type="file" name="blog_image" class="form-control" id="blog_image">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả </label>
                        <textarea class="form-control" name="blog_description" id="blog_desc"  required placeholder="Mô tả sản phẩm"></textarea> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung </label>
                        <textarea class="form-control" name="blog_content" id="ckeditor"  required placeholder="Nội dung bài viêt"></textarea> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Từ khoá seo</label>
                        <textarea class="form-control" name="blog_keyword" id="blog_keyword"  required placeholder="Từ khoá seo"></textarea> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                        <select name="blog_status" class="form-control input-sm m-bot15">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    <button type="button" onclick="checkform()" name="add_category_product" class="btn btn-info">Thêm Bài viết mới</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script language="javascript">

    /*Khi thay đổi tiêu đề bài viết thì cập nhật giá trị nội dung vào ô url_key*/
    $(document).ready(function()
    {
        document.getElementById("menu-blogs").className = "dcjq-parent active";
        document.getElementById("add_blog").className = "active";

        $("#blog_title").blur(function(){
            var _token = $('input[name="_token"]').val();
            var title = (document.getElementById("blog_title").value);
            

            /*Kiểm tra và tiêu đề mã có bị trùng không bằng ajax*/
            $.ajax({
                type:"post",
                url: "{{url('/check-title')}}",
                data: {blog_title:title,_token:_token},
                success:function(data){
                    /*Đã tồn tại tiêu đề xoá bắt nhập lại*/
                    if(data == "exist")
                    {
                        swal("Đã có lỗi", "Tiêu đề đã tồn tại");
                        $("#blog_title").val("");
                        $("#blog_code").val("");
                        return;
                    }
                    /*end: if(data == "exist")*/

                    /*nếu chưa tồn tại thì tạo mã blog*/
                    if(data == "check_ok")
                    {
                        var str= title.toLowerCase();
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
                        $("#blog_code").val(str);
                    }
                }
            })

            

            

            
        })
    });

    /*kiểm tra thông tin form*/
    function checkform()
    {
        if(document.getElementById('blog_title').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng điền tiêu đề bài viết");
            return;
        }
        if(document.getElementById('blog_code').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng điền mã bài viết");
            return;
        }
        if(document.getElementById('blog_image').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng chọn hình ảnh của bài viết");
            return;
        }
        if(document.getElementById('blog_desc').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập mô tả bài viết");
            return;
        }
        if(document.getElementById('blog_keyword').value == "")
        {
            swal("Gặp lỗi rồi !!!", "Vui lòng nhập từ khoá seo cho bài viết");
            return;
        }

        document.getElementById("form_add_blog").submit();
        document.getElementById("form_save_image_about").submit();
    }

</script>
@endsection
