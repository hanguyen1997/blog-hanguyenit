@extends('public.layouts.layout')
@section('title', trans('admin.category.index.title'))
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
        <div class="col-lg-4 col-md-6">
          <div class="journal-info mb-30">
            <a href="{{URL::to('detail-blog/'.$blog->blog_code)}}"><img src="{{asset('public/uploads/'.$blog->blog_image)}}" class="img-responsive" alt="img" style="object-fit: cover;width:100%;height: 300px;"></a>
            <div class="journal-txt">
              <h4><a href="{{URL::to('detail-blog/'.$blog->blog_code)}}">{{$blog->blog_title}}</a></h4>
              <p class="separator">{{$blog->blog_description}}
              </p>
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