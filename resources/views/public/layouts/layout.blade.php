<!DOCTYPE html>
<html lang="en">
 <head> 
  <!-- SEO -->
  <meta name="description" content="@yield('desc')"/>
  <meta name="keywords" content="@yield('keyword')"/>
  <meta name="robots" content="INDEX,FOLLOW"/>
  <link  rel="canonical" href="<?php echo url()->previous();?>" />
  <meta name="rating" content="adult"/>
  <meta name="rating" content="RTA-5042-1996-1400-1577-RTA" />
  <meta name="Generator" content="hanguyenit (c) 2020" />
  <!-- share  -->
  <?php 
    /*nếu có $url_image từ detail_blog thì hiển thị*/
    if(isset($url_image)) {?>
      <meta property="og:image" content="{{$url_image}}" />
  <?php }?>
  <!-- Đổi khi có domain -->
  <meta property="og:site_name" content="http://localhost/blog-hanguyenit" />
  
  <meta property="og:description" content="@yield('desc')" />
  <meta property="og:title" content="@yield('title')" />
  <meta property="og:url" content="<?php echo url()->current();?>" />
  <meta property="og:type" content="website" />
  
  <!-- meta -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="{{asset('public/fontend/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="{{asset('public/fontend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/fontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/fontend/lib/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
  <link href="{{asset('public/fontend/lib/hover/hover.min.css')}}" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="{{asset('public/fontend/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('public/fontend/css/blog.css')}}" rel="stylesheet">
  <!-- Responsive css -->
  <link href="{{asset('public/fontend/css/responsive.css')}}" rel="stylesheet">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('public/fontend/images/logo-chữ-N-59.gif')}}">
  <!-- alert css -->
</head>
<body>
  <!-- start section navbar -->
    @yield('menu')
  <!-- End section navbar -->
  <!-- start section main content -->
    @yield('content')
    <!-- End section main content-->
  <!-- start section footer -->
    @include('public/layouts/footer')
  <!-- End section footer -->

  <!-- JavaScript Libraries -->
  <script src="{{asset('public/fontend/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/typed/typed.js')}}"></script>
  <script src="{{asset('public/fontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/magnific-popup/magnific-popup.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/isotope/isotope.pkgd.min.js')}}"></script>

  <!-- thư viện alert css -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <!-- Contact Form JavaScript File -->
  <script src="{{asset('public/fontend/contactform/contactform.js')}}"></script>
  <!-- Template Main Javascript File -->
  <script src="{{asset('public/fontend/js/main.js')}}"></script>
 
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=219426959419501&autoLogAppEvents=1" nonce="e4T6g9wP"></script>
</body>
</html>
