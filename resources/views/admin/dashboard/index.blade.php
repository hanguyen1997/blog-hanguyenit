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

<div class="col-md-12 stats-info stats-last widget-shadow">
	<div class="stats-last-agile">
		<table class="table stats-table ">
			<thead>
				<tr>
					<th>Blog</th>
					<th>Tổng view</th>
					<th>Trạng thái</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$array_status = array("1"=>"Hiển thị", "0"=>"Đang ẩn");
				?> 
				@foreach($array_blog_most_view as $key => $row)
					<tr>
						<td>{{$row->blog_title}}</td>
						<td><span class="label label-info">{{$row->viewcount}}</span></td>
						<?php 
							$status = $array_status[$row->blog_status];

							if($row->blog_status == "1") $class_status = "label label-success";
							else $class_status = "label label-danger";
						?>

						<td><span class="<?= $class_status ?>"><?= $status ?></span></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection