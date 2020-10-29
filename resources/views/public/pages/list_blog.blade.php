@extends('public.layouts.layout')

@section('desc', "Mình là Nguyên, là một lập trình viên thích đọc và học, mình tạo ra blog này để chia sẽ về những câu chuyện xung quanh cuộc sống mình và cũng như trong công việc mà mình gặp phải.")
@section('title',"Danh sách blog - Hà nguyên IT")
@section('keyword', "blog-hanguyenit, blog, hanguyenit,list blog, blog it")
@section('menu')
  @include('public/layouts/menu')
@endsection('menu')

@section('content')

<style type="text/css">
  .inner-form{
    width: 100%;
    margin-bottom: 17px;
  }
  .input-field{
    height: 50px;
    width: 100%;
    position: relative;
  }
  .btn-search{
    outline: none;
    width: 70px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    position: absolute;
    left: 0;
    height: 100%;
    background: transparent;
    border: 0;
    padding: 0;
    cursor: pointer;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    align-items: center;
  }
  #search{
    outline: none;
    height: 100%;
    width: 100%;
    background: transparent;
    background: #fff;
    display: block;
    width: 100%;
    padding: 10px 32px 10px 70px;
    font-size: 18px;
    color: #666;
    border-radius: 34px;
  }
</style>
<!-- start section journal -->
<div id="journal-blog" class="text-left  paddsections">
  <div class="container">
    <div class="section-title text-center">
      <h2>Blog</h2>
    </div>
    <div class="inner-form">
      <div class="input-field">
        <form action="{{URL::to('/list-blog')}}" method="get" >
          <button class="btn-search" type="submit" style="outline: none;">
            <svg  width="24" height="24" viewBox="0 0 24 24">
            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
            </svg>
          </button>
          <input id="search" name="search_blog"  type="text" placeholder="Tìm kiếm" value="{{$search}}">
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="journal-block">
      <div class="row">
        <?php 
          /*check array_blog */
          if($array_blog[0] == "") echo "<div style='margin: 0 auto;margin-bottom: 20px'><span>Dữ liệu đang cập nhập</span></div>";
          else
          {
        ?>
          @foreach ($array_blog as $blog)
          <div class="box-blog" style="width: 100%;">
            <div class="journal-info mb-30">
              <div class="journal-txt">
                <h4><a href="{{URL::to('detail-blog/'.$blog->blog_code)}}">{{$blog->blog_title}}</a></h4>
                <div>
                  <span>
                    <i class="ion-android-calendar" ></i> <?php echo date('d/m/Y', strtotime($blog->created_at));?>
                  </span>
                  <span style="padding-left: 15px;">
                    <span class="fb-comments-count" data-href="{{URL::to('detail-blog/'.$blog->blog_code)}}"></span> Comment 
                  </span>
                  <span style="padding-left: 15px;">
                    <i class="ion-android-person"></i> 
                    {{$blog->user->name}}
                  </span>
                  
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
        <?php }/*end: if($array_blog == null)*/ ?>
      </div>
      {{ $array_blog->links() }}
    </div>
  </div>
</div>

<!-- End section journal -->
@endsection