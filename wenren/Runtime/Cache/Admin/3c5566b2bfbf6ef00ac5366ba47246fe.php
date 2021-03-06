<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">		
		<title><?php echo ($meta_title); ?> | <?php echo C('WEB_SITE_TITLE');?></title>
	    <!-- Tell the browser to be responsive to screen width -->
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="/Public/AdminLTE2/plugins/bootstrap/css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="/Public/AdminLTE2/plugins/font-awesome/4.4.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="/Public/AdminLTE2/plugins/ionicons/2.0.0/css/ionicons.min.css">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="/Public/AdminLTE2/dist/css/AdminLTE.min.css">
	    <!-- iCheck -->
	    <link rel="stylesheet" href="/Public/AdminLTE2/plugins/iCheck/square/blue.css">
	    
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
			<script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>	    
			<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>	        
	    <![endif]-->
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>后台登录</b></a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg"></p>
				<form action="/Public/login.html" method="post" class="login-form">
					<div class="form-group has-feedback">
						<input name="username" type="text" class="form-control" placeholder="账号">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input name="password" type="password" class="form-control" placeholder="密码">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
				                	<input name="remember" type="checkbox" value="1"> 记住我(自动登录一周)
				                </label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat ajax-post" target-form="login-form">登录</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
	
		<!-- jQuery 2.1.4 -->
		<script src="/Public/AdminLTE2/plugins/jQuery/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="/Public/AdminLTE2/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="/Public/AdminLTE2/plugins/iCheck/icheck.min.js"></script>
		<!-- Common -->
		<script src="/Public/Admin/js/common.js"></script>
		<script>
			$(function() {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
		</script>
	</body>
</html>