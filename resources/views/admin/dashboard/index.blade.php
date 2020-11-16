@extends('admin.layouts.admin_layout')
@section('content')
<!-- //market-->
<div class="market-updates">
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-2">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-eye"> </i>
			</div>
			 <div class="col-md-8 market-update-left">
			 <h4>Sô lượt truy cập bài viết</h4>
			<h3>{{$count_view_blog}}</h3>
		  </div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-1">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-rss" style="font-size:3em; color:#fff; text-align:left;"></i>
			</div>
			<div class="col-md-8 market-update-left">
			<h4>Tổng số bài viết</h4>
				<h3>{{$count_blog}}</h3>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-4">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-connectdevelop" style="font-size:3em; color:#fff; text-align:left;"></i>
			</div>
			<div class="col-md-8 market-update-left">
				<h4>Tổng số liên hệ</h4>
				<h3>{{$count_contact}}</h3>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>

   <div class="clearfix"> </div>
</div>	
<div class="clearfix"> </div>


@endsection