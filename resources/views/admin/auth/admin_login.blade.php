<!DOCTYPE html>
<head>
<title>Admin | Hà Nguyên  blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="public/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="public/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="public/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="public/backend/css/font.css" type="text/css"/>
<link href="public/backend/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="public/backend/js/jquery2.0.3.min.js"></script>
</head>
<body style="height: 100vh">
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng Nhập</h2>
		<?php
		/*Lấy thông báo từ admincontroller*/
		$message = Session::get('message');

		/*Nếu tồn tại thông báo*/
		if(isset($message))
		{ 
			echo "<span style='color:red; width:100%; text-align: center;'>$message</span>";
			Session::put('message', NULL);
		}
		?>
		<form action = "{{URL::to('/check-login')}}" method="POST">
			@csrf
			<input type="text" class="ggg" name="user_email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="user_password" placeholder="PASSWORD" required="">
			<span><input type="checkbox" />Lưu lại thông tin</span>
			<h6><a href="#">Lấy lại mật khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng Nhập" name="login">
		</form>
		<p>Bạn chưa có tài khoản ?<a href="registration.html">Đăng Ký</a></p>
</div>
</div>
<script src="public/backend/js/bootstrap.js"></script>
<script src="public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="public/backend/js/scripts.js"></script>
<script src="public/backend/js/jquery.slimscroll.js"></script>
<script src="public/backend/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="public/backend/js/jquery.scrollTo.js"></script>
</body>
</html>
