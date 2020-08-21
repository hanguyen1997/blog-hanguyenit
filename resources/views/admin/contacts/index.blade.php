@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
  thead tr th {
      border: solid 1px;  
  }
  .ajax-data tr td {
      border: solid 1px;  
  }
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách liên hệ
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người liên hệ</th>
            <th>Gmail</th>
            <th>Nội dung tin nhắn</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tbody class ="ajax-data" >
          
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
        url: "{{URL('/ajax-list-contact')}}",
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