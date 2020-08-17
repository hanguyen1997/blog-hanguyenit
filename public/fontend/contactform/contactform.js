$(document).ready(function(){
    
  //Contact
  $('form.contactForm').submit(function() {
    var name_contact = $('#name_contact').val();
    if(name_contact == "" ) {
      swal("Đã Có lỗi !!!", "Vui lòng nhập tên của bạn");return false;
    }
    
    /*Kiểm tra email ó hợp lệ không*/
    var email_contact = $('#email_contact').val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if (!filter.test(email_contact)) { 
      swal("Đã Có lỗi !!!", "Vui lòng nhập địa chị email hợp lệ");return false;
    }

    /*Kiểm tra nội dung*/ 
    var message_contact =  $.trim($("#message_contact").val())
    if(message_contact == "") {
      swal("Đã Có lỗi !!!", "Vui lòng nhập nội dung tin nhắn");return false;
    }
    /*Kiểm tra nội dung nếu kis tự < 4 thì thông báo*/
    var message_contact_count = message_contact.length;
    if(message_contact_count <= 4) {
      swal("Đã Có lỗi !!!", "Nội dung tin nhắn không phù hợp");return false;
    }
    /*token*/
    var _token = $('input[name="_token"]').val();
    $.ajax({
      type: "post",
      url: 'http://localhost/blog-hanguyenit/contact',
      data: {
        _token:_token,
        name_contact:name_contact,
        email_contact:email_contact,
        message_contact:message_contact
      },
      success:function(data){
        if(data == "oke")
        {
          swal("Thành công", "Mình rất vui khi nhận được sự góp ý của bạn", "success");
        }
        else{
          swal("Có gì đó không ổn, vui lòng thử lại");
        }
      }
    });
    return false;
  });
});