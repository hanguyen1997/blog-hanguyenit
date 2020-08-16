@extends('public.layouts.layout')

@section('desc', "$blog_description")

@section('title', "$blog_title - HanguyenIT")

@section('keyword', "$blog_keyword")

@section('menu')
  @include('public/layouts/menu')
@endsection('menu')

@section('content')
<div class="main-content paddsection">
  <div class="s">
    <div class="row justify-content-center">
      <div class="col-md-8 col-md-offset-2">
        <div class="row">
          @foreach ($array_detail_blog as $key => $blog_detail)
          <div class="container-main single-main">
            <div class="col-md-12">
              <div class="block-main mb-30">
                <img style="width: 100%;height: 500px;object-fit: contain;margin-bottom: 20px;" src="{{asset('public/uploads/'.$blog_detail->blog_image)}}" class="img-responsive" alt="reviews2">
                <div class="content-main single-post padDiv">
                  <div class="journal-txt">
                    <h4 style="text-align: center;"><a href="#">{{$blog_detail->blog_title}}</a></h4>
                  </div>
                  <div class="post-meta">
                    <ul class="list-unstyled mb-0">
                      <li class="">Date : <?php echo date("d/m/Y", strtotime($blog_detail->created_at)); ?></li>
                      <li class="commont">
                        <i class="ion-ios-heart-outline"></i> 
                        <!-- count comment -->
                        <span class="fb-comments-count" data-href="<?php echo url()->current();?>"></span>
                        Comments
                      </li>
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
            <div class="fb-comments" data-href="<?php echo url()->current();?>" data-numposts="20" style="padding: 20px;" data-width="100%">
            </div>
            <!-- end: commnet facebook -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--  </div class="main-content paddsection"> -->
@endsection