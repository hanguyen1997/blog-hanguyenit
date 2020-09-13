@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
	.b-light td {
		text-align: center;
	} 
	.b-light th {
		text-align: center;
	} 
</style>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhóm người dùng mới
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form id="form_save_user_group" role="form" action="{{URL::to('/save-user-group')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tên Nhóm người dùng mới</label>
                        <div id='notify_user_name_group'></div>
                        <input type="text" name="user_group_name" class="form-control" id="user_group_name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả </label>
                        <textarea class="form-control" name="blog_description" id="blog_desc"  required ></textarea> 
                    </div>
                    <button onclick="checkform()" type="button" name="add_category_product" class="btn btn-info">Thêm nhóm người dùng mới</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 14px">
      Danh sách nhóm người dùng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên nhóm</th>
            <th>Mô tả</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tbody id="ajax-data" >
          
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		/*dùng ajax để hiện thị danh sách*/
		function fetch_data(){
		$.ajax({
		  method: 'get',
		  url: "{{URL('/index-user-group-name')}}",
		  success:function(data){
		    $('#ajax-data').html(data);
		  }
		})
		}
		/*end: function fetch_data()*/

		/*gọi hàm load danh sách nhóm user by ajax*/
		fetch_data();

		/*Check if the user_group_name already exists ?*/
		$('#user_group_name').blur(function(){
			var user_group_name = (document.getElementById("user_group_name").value);
			if(user_group_name != "")
			{
				/*check user_group_name by ajax*/
            	$.ajax({
            		type: "post",
            		url: "{{URL('/check-user-group-name')}}",
            		data: {user_group_name:user_group_name},
            		success:function(data){
            			if(data = "check_ok")
            			{
            				document.getElementById("notify_user_name_group").html("Nhóm này có thể sữ dụng");
            			}
            			else{
            				document.getElementById("notify_user_name_group").html("Nhóm này đã tồn tại");
            			}
						/*end: if(data = "check_oke")*/
            		}
            	})
			}
		})
	})

	/*kiểm tra form*/
	function checkform(){
		if(document.getElementById("user_group_name").value == "")
		{
			swal("Vui lòng nhập tên nhóm người dùng mới ");
		}
		/*end: if(document.getElementById("user_group_name").value == "")*/

		/*submit form*/
		document.getElementById("form_save_user_group").submit();
	}

</script>
@endsection