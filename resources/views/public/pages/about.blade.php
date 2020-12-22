@extends('public.layouts.layout')

@section('desc', "Trang thông tin chi tiết blog")
@section('title', "About blog - HanguyenIT")
@section('keyword', "blog, hanguyenit, hanguyen, about")

@section('menu')
  @include('public/layouts/menu')
@endsection('menu')

@section('content')
<div id="about" class="paddsection">
  <div class="container">
    <div class="row justify-content-between">

      <div class="col-lg-4 ">
        <div class="div-img-bg">
          <div class="about-img">
            <img src="{{asset('public/fontend/images/57161061_1682813328530900_5025365504462684160_n (1).jpg')}}" class="img-responsive" alt="me">
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="about-descr">
          <p class="p-heading">Xin chào ai đó ghé thăm blog này. </p>
          <p class="separator">Mình là Nguyên. Tên đầy đủ của mình là <a href="#">Trương bá hà nguyên</a> năm nay 24 tuổi. Hiện đang sinh sống và làm việc tại Đà Nẵng.</p>
          <p class="separator">Là một người thích đọc và học. Mình bắt đầu với lập trình ở vị trí thực tập. Mình học lập trình qua các dự án và các anh chị lớn tuổi hơn, những lần ngồi nghe như “vịt nghe sấm” khi mọi người họp, xem các anh em chém gió khi đi caffe. Rồi từ những lần biết viết code ngớ ngẩn, được nghe các anh trình bày, giải thích. Và những ngày tháng ngồi lại học sau giờ làm. Mình đã trải qua những tháng ngày đầu tiên đó theo cái cách vất vả nhất khi không có người hướng dẫn, training.</p>
          <p class="separator">Đó là động lực để mình viết Blog, mình thật sự rất muốn mình của hiện tại có thể giúp được mình ở thời gian đó. Điều đó chắc chắn sẽ không thể thực hiện được, nhưng không sao sẽ còn rất nhiều các bạn mới vào nghề, cũng đi từng bước, cũng ngu ngơ nai tơ như vậy. Mình không dám chắc những điều mình viết là chuẩn nhất, đúng nhất, mà chỉ hi vọng blog này sẽ là một nơi đưa lại cho bạn cái nhìn cách gần gũi nhất của một lập trình viên.</p>
          <p class="separator">Nếu bạn thấy những bài viết của mình giúp ích gì đó cho bạn mong các bạn đón nhận và tiếp tục đọc blog. Thanks!</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
