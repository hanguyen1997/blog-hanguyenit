@extends('public.layouts.layout')

@section('desc', "Mình là Nguyên, là một lập trình viên thích đọc và học, mình tạo ra blog này để chia sẽ về những câu chuyện xung quanh cuộc sống mình và cũng như trong công việc mà mình gặp phải.")
@section('title', "Blog Hà Nguyên IT")
@section('keyword', "blog-hanguyenit, blog, hanguyenit")

@section('menu')
<nav id="main-nav">
  <div class="row">
    <div class="container">

      <div class="logo">
        <a href="{{URL::to('/')}}"><img src="{{asset('public/fontend/images/logo-chữ-N-59.gif')}}" alt="logo"></a>
      </div>

      <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div>

      <ul class="nav-menu list-unstyled">
        <li><a href="#header" class="smoothScroll">Trang Chủ</a></li>
        <li><a href="#about" class="smoothScroll">Thông Tin</a></li>
        <li><a href="#journal" class="smoothScroll">Blog</a></li>
        <li><a href="#contact" class="smoothScroll">Liên hệ</a></li>
      </ul>
    </div>
  </div>
</nav>
@endsection('menu')

@section('content')
<!-- start section header -->
<div id="header" class="home">

  <div class="container">
    <div class="header-content">
      <h1>I'm <span class="typed"></span></h1>
      <p>Hà Nguyên, developer, live in Đà Nẵng</p>

      <ul class="list-unstyled list-social">
        <li><a href="https://www.facebook.com/profile.php?id=100004067478544"><i class="ion-social-facebook"></i></a></li>
        <li><a href="https://www.instagram.com/h.nguyen.11/"><i class="ion-social-instagram"></i></a></li>
        <li><a href="https://aboutme.google.com/u/0/?referer=gplus"><i class="ion-social-googleplus"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<!-- End section header -->

<!-- start section about us -->
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
          <p class="separator">Mình là Nguyên, là một lập trình viên thích đọc và học. Hiện tại mình đang sống và làm việc tại thành phố Đà Nẵng. Mình bắt đầu với lập trình ở vị trí thực tập , những lần viết code ngớ ngẩn, được nghe các anh các thầy trình bày, giải thích. Và những ngày tháng ngồi lại học sau giờ làm. Mình đã trải qua những tháng ngày đầu tiên đó theo cái cách vất vả nhất khi không có người hướng dẫn, training.</p>
          <p class="separator">Đó cũng là động lực để mình viết Blog, Sẽ còn rất nhiều các bạn mới vào nghề, cũng đi từng bước, cũng ngu ngơ nai tơ như vậy. Mình không dám chắc những điều mình viết là chuẩn nhất, đúng nhất, mà chỉ hi vọng blog này sẽ là một nơi đưa lại cho bạn cái nhìn cách gần gũi nhất của một lập trình viên.</p>
          <p class="separator">Nếu bạn thấy những bài viết của mình giúp ích gì đó cho bạn mong các bạn đón nhận và tiếp tục đọc blog. Thanks!</p>
        </div>
        <div class="text" style="margin-top: 20px">
        <a href="{{url::to('/about')}}">Xem thêm về tôi</a>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- end section about us -->

<!-- start section services -->
<div id="services">
  <div class="container">
    <div class="services-carousel owl-theme">
      @foreach($array_image_blog as $key => $image)
      <div class="services-block">
        <img src="{{asset('public/uploads/'.$image->image)}}"  style="width: 100%;object-fit: cover; height: 300px;" class="" alt="me">
      </div>
      @endforeach
    </div>
  </div>
</div>
<!-- end section services -->

<!-- start section journal -->
<div id="journal" class="text-left paddsection">
  <div class="container">
    <div class="section-title text-center">
      <h2>Blogs</h2>
    </div>
  </div>
  <div class="container">
    <div class="journal-block">
      <div class="row">
        <?php 
        // echo "<pre>";
        // print_r($array_blog);
        // echo "</pre>";

        if($array_blog == NULL || (count($array_blog) == 0)) echo "<div style='margin: 0 auto;margin-bottom: 20px'><span>Dữ liệu đang cập nhập</span></div>";
        else 
        {
        ?>
        @foreach ($array_blog as $key => $post)
        <div class="col-lg-4 col-md-6">
          <div class="journal-info">
            <a href="{{URL::to('detail-blog/'.$post->blog_code)}}"><img src="{{asset('public/uploads/'.$post->blog_image)}}" style="object-fit: cover;width:100%;height: 200px;" class="img-responsive" alt="img"></a>
            <div class="journal-txt">
              <h4 style="height: 67px;"><a style="overflow: hidden;-webkit-line-clamp: 2;display: -webkit-box;-webkit-box-orient: vertical; line-height: 32px;" href="{{URL::to('detail-blog/'.$post->blog_code)}}">{{$post->blog_title}}</a></h4>
              <div style="margin-top: 10px">
                <span>
                  <i class="ion-android-calendar" ></i> <?php echo date('d/m/Y', strtotime($post->created_at));?>
                </span>
                <span style="padding-left: 5px;">
                   <i class="ion-android-chat" ></i>
                  <span class="fb-comments-count" data-href="{{URL::to('detail-blog/'.$post->blog_code)}}"></span>
                </span>
                <span style="padding-left: 5px;"><i class="ion-android-person"></i> {{$post->user->name}}</span>
              </div>
              <p style="overflow: hidden;-webkit-line-clamp: 5;display: -webkit-box; -webkit-box-orient: vertical;" class="separator">{{$post->blog_description}}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div style="margin-top: 15px;" class="text-center">
        <a href="{{url::to('list-blog')}}">Xem thêm</a>
      </div>
      <?php 
          }/*end: if($array_blog == NULL)*/
        ?>
    </div>
  </div>
</div>
<!-- End section journal -->

<!-- start sectoion contact -->
<div id="contact" class="paddsection">
  <div class="container">
    <div class="contact-block1">
      <div class="row">
        <div class="col-lg-6">
          <div class="contact-contact">
            <h2 class="mb-30">Liên Hệ Tôi</h2>
            <ul class="contact-details">
              <li><span>304 Lê Văn Hiến, Street</span></li>
              <li><span>Đà Nẵng , Việt Nam</span></li>
              <li><span>+84 935.410.769</span></li>
              <li><span>truongbahanguyen@gmail.com</span></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <form action="" method="post" role="form" class="contactForm">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group contact-block1">
                  <input type="text" name="name_contact" class="form-control" id="name_contact" placeholder="Tên của bạn" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email_contact" placeholder="Email của bạn" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="12" id="message_contact" data-msg="Please write something for us" placeholder="Tin Nhắn"></textarea>
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-lg-12">
                <input type="submit" class="btn btn-defeault btn-send" value="Send message">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection