@extends('public.layouts.layout')

@section('desc', "$blog_description")
@section('title', "$blog_title - HanguyenIT")
@section('keyword', "$blog_keyword")
@section('menu')
  @include('public/layouts/menu')
@endsection('menu')

@section('content')
<div class="main-content paddsection">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-md-offset-2">
        <div class="row" style="margin-top: 80px;">
          @foreach ($array_detail_blog as $key => $blog_detail)
          <div class="container-main single-main">
            <div class="col-md-12">
              <div class="block-main mb-30">
                <img style="width: 100%;object-fit: contain;margin-bottom: 20px;" src="{{asset('public/uploads/'.$blog_detail->blog_image)}}" class="img-responsive" alt="reviews2">
                <div class="content-main single-post padDiv">
                  <div class="journal-txt">
                    <h1 style="text-align: center;"><a href="#">{{$blog_detail->blog_title}}</a></h1>
                  </div>
                  <div class="post-meta">
                    <ul class="list-unstyled mb-0">
                      <li class=""><i class="ion-android-calendar" ></i> <?php echo date("d/m/Y", strtotime($blog_detail->created_at)); ?></li>
                      <li class="commont">
                        <!-- count comment -->
                        <span class="fb-comments-count" data-href="<?php echo url()->current();?>"></span>
                        Comments
                      </li>
                      <li class="">
                        <i class="ion-android-person"></i> {{$blog_detail->user->name}}</li>
                    </ul>
                  </div>
                  <p class="mb-30">{!!$blog_detail->blog_content!!}</p>
                  <!-- like and share facebook -->
                  <div class="fb-like" data-href="<?php echo url()->current();?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                </div>
              </div>
            </div>
            @endforeach
            <!-- commnet facebook -->
            <div class="content-main single-post padDiv">
              <div class="fb-comments" data-href="<?php echo url()->current();?>" data-numposts="20" data-width="100%">
              </div>
            </div>
            <!-- end: commnet facebook -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- more blog -->
  <div class="container">
    <div class="row">
      @foreach ($array_more_blog as $key => $blog)
      <div class="col-lg-4 col-md-6" style="margin-top: 20px">
        <div class="journal-info">
          <a href="{{URL::to('detail-blog/'.$blog->blog_code)}}"><img src="{{asset('public/uploads/'.$blog->blog_image)}}" style="object-fit: cover;width:100%;height: 200px;" class="img-responsive" alt="img"></a>
          <div class="journal-txt" style="margin: 10px;">
            <h4 style="height: 67px;"><a style="overflow: hidden;-webkit-line-clamp: 2;display: -webkit-box;-webkit-box-orient: vertical; line-height: 32px;font-size: 20px;" href="{{URL::to('detail-blog/'.$blog->blog_code)}}">{{$blog->blog_title}}</a></h4>
            <div style="margin-top: 10px">
              <span>
                <i class="ion-android-calendar" ></i> <?php echo date('d/m/Y', strtotime($blog->created_at));?>
              </span>
              <span style="padding-left: 5px;">
                 <i class="ion-android-chat" ></i>
                <span class="fb-comments-count" data-href="{{URL::to('detail-blog/'.$blog->blog_code)}}"></span>
              </span>
              <span style="padding-left: 5px;"><i class="ion-android-person"></i> {{$blog->user->name}}</span>
            </div>
            <p style="overflow: hidden;-webkit-line-clamp: 5;display: -webkit-box; -webkit-box-orient: vertical;" class="separator">{{$blog->blog_description}}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!--  </div class="main-content paddsection"> -->
@endsection