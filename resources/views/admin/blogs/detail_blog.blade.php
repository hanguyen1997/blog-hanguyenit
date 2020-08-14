@extends('admin.layouts.admin_layout')
@section('content')
<div class="typo-agile">
	<a href="{{URL::to('/all-blog')}}"><i class="fa fa-backward">Quay lại</i></a>
	<h2 class="w3ls_head">Chi tiết tin</h2>
	<div class="grid_3 grid_4 w3layouts">
		@foreach($array_blog as $key => $blog)
		<h3 class="hdg">{{$blog->blog_title}}</h3>
		<div class="bs-example">
			<table class="table">
				<tbody>
					<?php echo $blog->blog_content; ?>
				</tbody>
			</table>
		</div>
		@endforeach
	</div>
	<a href="{{URL::to('/all-blog')}}"><i class="fa fa-backward">Quay lại</i></a>
</div>
@endsection