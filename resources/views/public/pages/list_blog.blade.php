@extends('public.layouts.layout')
@section('desc', "Mình là Nguyên, là một lập trình viên thích đọc và học, mình tạo ra blog này để chia sẽ về những câu chuyện xung quanh cuộc sống mình và cũng như trong công việc mà mình gặp phải.")
@section('title',"Danh sách blog - Hà nguyên IT")
@section('keyword', "blog-hanguyenit, blog, hanguyenit,list blog, blog it")

@section('menu')
  @include('public/layouts/menu')
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
        @foreach ($array_blog as $blog)
        <div class="box-blog">
          <div class="journal-info mb-30">
            <div class="journal-txt">
              <h4><a href="{{URL::to('detail-blog/'.$blog->blog_code)}}">{{$blog->blog_title}}</a></h4>
              <div>
                <span>Date:  1/1/2020,</span>
                <span><i class="ion-ios-heart-outline"></i> 3 Comments</span>
              </div>
              <p class="separator">{{$blog->blog_description}}
              </p>
              <div> 
                <a href="{{URL::to('detail-blog/'.$blog->blog_code)}}">READ MORE</a>
              </div>
            </div>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>
</div>
<!-- End section journal -->
@endsection