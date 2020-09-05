@extends('admin.layouts.admin_layout')

@section('content')
<style type="text/css">
  a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;
 
    text-decoration: none;
    color: initial;
  }
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách người dùng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Họ và tên</th>
            <th>Gmail</th>
            <th>Nhóm người dùng</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tbody class ="ajax-data" >
          @foreach($array_user as $key => $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>Admin</td>
            <td>
            <button style='background:red;'>
              <a style='color:white' href='#' data-id='".$user->id."' >Xoá</a>
            </button>
            <button  style='background:#6464f3;'>
              <a style='color:white' href='{{URL('detail_user')}}' data-id='".$user->id."'>Chi tiết</a>
            </button>
            <button  style='background:#57a957;'>
              <a style='color:white' href='#' data-id='".$user->id."'>Đổi mật khẩu</a>
            </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){

    /*Load dữ liệu danh sách contact bằng ajax*/
    function fetch_data(){
      $.ajax({
        method: "GET",
        url: "{{URL('/ajax-list-user')}}",
        success:function(data){
          $('.ajax-data').html(data);
        }
      })
    }
    fetch_data();

    /*Xoá contact bằng ajax*/
    $(document).on('click','#button_del_contact',function(){
      /*Lấy id_contact*/
      var id_contact = $(this).data('id_contact');

      /*Hiển thị thông báo xác nhận xoá*/
      swal({
        title: "Bạn có muốn xoá liên hệ này không ?",
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
            url: "{{URL('/dell-contact')}}",
            data:{id_contact:id_contact},
            success:function(data){
              if(data == "done")
              {
                /*gọi hàm làm mới lại danh sách và thông báo xoá thành công*/
                fetch_data();
                swal("Đã xoá thành công", {icon: "success",});
              }
            }
          })
        }else
        {
          swal("Quay lại");
        }
        /*end: if (willDelete)*/
      });
    })


  })
</script>
@endsection