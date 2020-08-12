<!DOCTYPE html>
<html lang="en">
 <head> 
  <!-- alert css -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- meta -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ha Nguyen blog</title>
  <meta content="" name="keywords">
  <meta content="" name="description">

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

  <!-- Responsive css -->
  <link href="{{asset('public/fontend/css/responsive.css')}}" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('public/fontend/images/logo-chữ-N-59.gif')}}">

  <!-- =======================================================
    Theme Name: Folio
    Theme URL: https://bootstrapmade.com/folio-bootstrap-portfolio-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>

  <!-- start section navbar -->
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
  <!-- End section navbar -->
    @yield('content')
  <!-- start section footer -->
  <div id="footer" class="text-center">
    <div class="container">
      <div class="socials-media text-center">

        <ul class="list-unstyled">
           <li><a href="https://www.facebook.com/profile.php?id=100004067478544"><i class="ion-social-facebook"></i></a></li>
          <li><a href="https://www.instagram.com/h.nguyen.11/"><i class="ion-social-instagram"></i></a></li>
          <li><a href="https://aboutme.google.com/u/0/?referer=gplus"><i class="ion-social-googleplus"></i></a></li>
        </ul>

      </div>

      <p>&copy; Copyrights Hà Nguyên. All rights reserved.</p>

      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Folio
        -->
      </div>

    </div>
  </div>
  <!-- End section footer -->

  <!-- JavaScript Libraries -->
  <script src="{{asset('public/fontend/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/typed/typed.js')}}"></script>
  <script src="{{asset('public/fontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/magnific-popup/magnific-popup.min.js')}}"></script>
  <script src="{{asset('public/fontend/lib/isotope/isotope.pkgd.min.js')}}"></script>

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('public/fontend/contactform/contactform.js')}}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{asset('public/fontend/js/main.js')}}"></script>

</body>

</html>
