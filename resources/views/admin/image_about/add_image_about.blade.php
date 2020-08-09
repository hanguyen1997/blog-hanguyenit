@extends('admin_layout');
@section('content')
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
                        <input type="hidden" id="image_name">
                        <input type="file" name="image_about" class="form-control" id="image_about">
                    </div>
                    <button onclick="checkform()" type="button" name="add_category_product" class="btn btn-info">Thêm hình ảnh mới</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    
    /*Kiểm tra form*/ 
    function checkform() {

        /*Kiểm tra truyền hình ảnh lên không*/
        if(document.getElementById("image_about").value == "" )
        {
            alert('xin vui lòng chọn ảnh tải lên (*)');
            return;
        }
        document.getElementById("form_save_image_about").submit();
    }

</script>
@endsection
