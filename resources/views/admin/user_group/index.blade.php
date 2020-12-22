@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
	.b-light td {
		text-align: center;
	} 
	.b-light th {
		text-align: center;
	} 
  .check_dont_ok
  {
    color: red;
  }
  .check_ok{
    color: blue;
  }
  button{
    color: white;
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
                    <form id="form_save_user_group" role="form" action="{{URL::to('/save-user-group')}}" method="get" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tên Nhóm người dùng mới</label>
                        <input type="text" name="user_group_name" class="form-control" id="user_group_name">
                        <span id='notify_user_name_group'></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả </label>
                        <textarea class="form-control" name="user_group_des" id="user_group_des"  required ></textarea> 
                    </div>
                    <input type="hidden" name="id_user_group" id="id_user_group">
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
  /*active menu*/
  document.getElementById("menu-users").className = "dcjq-parent active";
  document.getElementById("list_group_user").className = "active";
});
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

$(document).ready(function(){
	/*gọi hàm load danh sách nhóm user by ajax*/
	fetch_data();

	/*Check if the user_group_name already exists ?*/
	$('#user_group_name').blur(function(){
		var user_group_name = (document.getElementById("user_group_name").value);
    var id_user_group = document.getElementById("id_user_group").value;

		if(user_group_name != "" &&  id_user_group == "")
		{
			/*check user_group_name by ajax*/
    	$.ajax({
    		type: "get",
    		url: "{{URL('/check-user-group-name')}}",
    		data: {user_group_name:user_group_name},
    		success:function(data){
    			if(data == "check_dont_ok")
    			{
            $('#notify_user_name_group').html("<p class='check_dont_ok' id='check_name'>Nhóm này đã tồn tại, không thể sữ dụng tển này</p>");
    			}
    			else{
    				$('#notify_user_name_group').html("<p class='check_ok' id='check_name'>Bạn có thể sữ dụng nhóm này</p>");
    			}
			    /*end: if(data = "check_oke")*/
    		}
    	})
		}
    else
    {
      $('#notify_user_name_group').html("");
    }
	})

  /*Xoá nhóm bằng ajax*/
  $(document).on('click','#button_del_user_group',function(){
    /*Lấy id_contact*/
    var id_user_group = $(this).data('id_user_group');

    /*Hiển thị thông báo xác nhận xoá*/
    swal({
      title: "Bạn có muốn nhóm người dùng này không ?",
      text: "Nếu đã xoá thì sẽ không khôi phục được!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if(willDelete)
      {
        /*Nếu đồng ý thì xoá dữ liệu bằng ajax*/
        $.ajax({
          method: "get",
          url: "{{URL('/del-user-group-name')}}",
          data:{id_user_group:id_user_group},
          success:function(data){
            if(data == "done")
            {
              /*gọi hàm làm mới lại danh sách và thông báo xoá thành công*/
              fetch_data();
              swal("Thành công", {icon: "success",});
            }
            else
            {
              /*không thể xoá admin hoặc không có id*/
              swal("Không thể xoá admin !!");
            }
            /*end: if(data == "done")*/
          }
        })
        /*end:  $.ajax({})*/
      }
    });
  })

  /*Xoá nhóm bằng ajax*/
  $(document).on('click','#button_edit_user_group',function(){
    /*Lấy id_contact*/
    var id_user_group = $(this).data('id_user_group');

    $.ajax({
      type: "get",
      url: "{{URL('/edit-user-group')}}",
      data: {id_user_group:id_user_group},
      success:function(data){
        if(data != "")
        {
          /*huyển đổi json thành một đối tượng JavaScript*/
          var json_user_group_edit = JSON.parse(data);
          $('#user_group_name').val(json_user_group_edit[0].user_group_name);
          $('#user_group_des').val(json_user_group_edit[0].user_group_des);
         $ ('#id_user_group').val(json_user_group_edit[0].id_user_group);
        }
        /*end if(!data)*/
      }
    })
  })
})

/*kiểm tra form và sumbit*/
function checkform(){
  var user_group_name = document.getElementById("user_group_name").value;
  var user_group_desc = document.getElementById("user_group_des").value;
  var id_user_group = document.getElementById("id_user_group").value;
  
  if(user_group_name == "" || user_group_name.trim().length == 0)
  {
    swal("Vui lòng không để trống tên nhóm người dùng mới");
  }

  if(user_group_desc == "" || user_group_desc.trim().length == 0)
  {
    swal("Vui lòng không để trống mô tả nhóm người dùng");
  }
  
  /*submit form save user_group by ajax*/
  $.ajax({
    method: "get",
    url: "{{URL('/save-user-group')}}",
    data:{user_group_name:user_group_name,
          user_group_desc:user_group_desc,
          id_user_group:id_user_group},
    success:function(data){
      if(data == "save" || data == "update")
      {
        // gọi hàm làm mới lại danh sách và thông báo thêm thành công+
        fetch_data();
        swal("Thành công", {icon: "success",});
        document.getElementById("form_save_user_group").reset();
        $('#notify_user_name_group').html("");
      }
      /*end: if(data == "save" || data == "eidt")*/
      if(data == "exit") swal("Tên nhóm đã tồn lại");
    }
  })
  /*end:  $.ajax({})*/
}
/*end: function checkform()*/
</script>
@endsection