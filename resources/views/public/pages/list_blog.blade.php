@extends('layout')
@section('title', trans('admin.category.index.title'))
@section('menu')
  <nav id="main-nav-subpage" class="subpage-nav">
    <div class="row">
      <div class="container">

        <div class="logo">
          <a href="index.html"><img src="images/logo.png" alt="logo"></a>
        </div>

        <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div>

        <ul class="nav-menu list-unstyled">
          <li><a href="https://www.facebook.com/" class="smoothScroll">Home</a></li>
          <li><a href="#about" class="smoothScroll">About</a></li>
          <li><a href="#portfolio" class="smoothScroll">Portfolio</a></li>
          <li><a href="#blog" class="smoothScroll">Blog</a></li>
          <li><a href="#contact" class="smoothScroll">Contact</a></li>
        </ul>

      </div>
    </div>
  </nav>
  <!-- End section navbar -->
@endsection('menu')

@section('content')
<!-- start section journal -->
<div id="journal-blog" class="text-left  paddsections">
<div class="container">
  <div class="section-title text-center">
    <h2>Blog</h2>
  </div>
</div>

<div class="container">
  <div class="journal-block">
    <div class="row">

      <div class="col-lg-4 col-md-6">
        <div class="journal-info mb-30">

          <a href="blog-single.html"><img src="images/blog-post-1.jpg" class="img-responsive" alt="img"></a>

          <div class="journal-txt">

            <h4><a href="blog-single.html">SO LETS MAKE THE MOST IS BEAUTIFUL</a></h4>
            <p class="separator">To an English person, it will seem like simplified English
            </p>

          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="journal-info mb-30">

          <a href="blog-single.html"><img src="images/blog-post-2.jpg" class="img-responsive" alt="img"></a>

          <div class="journal-txt">

            <h4><a href="blog-single.html">WE'RE GONA MAKE DREAMS COMES</a></h4>
            <p class="separator">To an English person, it will seem like simplified English
            </p>

          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="journal-info mb-30">

          <a href="blog-single.html"><img src="images/blog-post-3.jpg" class="img-responsive" alt="img"></a>

          <div class="journal-txt">

            <h4><a href="blog-single.html">NEW LIFE CIVILIZATIONS TO BOLDLY</a></h4>
            <p class="separator">To an English person, it will seem like simplified English
            </p>

          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="journal-info mb-30">

          <a href="blog-single.html"><img src="images/blog-post-1.jpg" class="img-responsive" alt="img"></a>

          <div class="journal-txt">

            <h4><a href="blog-single.html">SO LETS MAKE THE MOST IS BEAUTIFUL</a></h4>
            <p class="separator">To an English person, it will seem like simplified English
            </p>

          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="journal-info mb-30">

          <a href="blog-single.html"><img src="images/blog-post-2.jpg" class="img-responsive" alt="img"></a>

          <div class="journal-txt">

            <h4><a href="blog-single.html">WE'RE GONA MAKE DREAMS COMES</a></h4>
            <p class="separator">To an English person, it will seem like simplified English
            </p>

          </div>

        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="journal-info mb-30">

          <a href="blog-single.html"><img src="images/blog-post-3.jpg" class="img-responsive" alt="img"></a>

          <div class="journal-txt">

            <h4><a href="blog-single.html">NEW LIFE CIVILIZATIONS TO BOLDLY</a></h4>
            <p class="separator">To an English person, it will seem like simplified English
            </p>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!-- End section journal -->
@endsection