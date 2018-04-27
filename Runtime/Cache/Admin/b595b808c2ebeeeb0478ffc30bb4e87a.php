<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title><?php echo ($meta_title); ?> | <?php echo C('WEB_SITE_TITLE');?></title>
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="/Public/AdminLTE2/plugins/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="/Public/AdminLTE2/plugins/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="/Public/AdminLTE2/plugins/ionicons/2.0.0/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="/Public/AdminLTE2/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="/Public/AdminLTE2/dist/css/skins/_all-skins.min.css">
		<!-- -->	
		
	<style type="text/css">
		html, 
		body {
		    min-height: 100%;
		    height: 100%;
		}	
		.wrapper {
		    background-color: #ecf0f5 !important;
		    min-height: 100%;
		    height: 100%;
		}	
		.container {
		    min-height: 100%;
		    height: 100%;
		}
	</style>


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>	    
		<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>	
    	<![endif]-->
		<!-- jQuery 2.1.4 -->
		<script src="/Public/AdminLTE2/plugins/jQuery/jquery-2.1.4.min.js"></script>    	
	</head>

	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">

			<header class="main-header">
				<!-- Logo -->
				<a href="index2.html" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>E</b>CM</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Ejar</b>CMF</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<div class="navbar-header">
						<!-- Sidebar toggle button-->
						<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
							<i class="fa fa-caret-right"></i>
							<span class="sr-only">切换侧导航</span>
						</a>
						<!-- Navbar toggle button-->
						<a href="#" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#navbar-collapse" role="button">
							<span class="sr-only">切换主导航</span>
							<i class="fa fa-bars"></i>
							<i class="fa fa-caret-down"></i>
						</a>
					</div>

					<!-- Navbar Left Menu -->
					<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<ul class="nav navbar-nav">
							<?php if(is_array($__ALL_MENU_LIST__)): $i = 0; $__LIST__ = $__ALL_MENU_LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($vo['id'] == $__CURRENT_ROOTMENU__) echo 'class="active"'; ?> >
									<a href="<?php echo U($vo['url']);?>"><i class="<?php echo ($vo["icon"]); ?>"></i> <?php echo ($vo["title"]); ?></a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?php echo (get_cover($__MEMBER__["avatar"],'avatar')); ?>" class="user-image" alt="User Image">
									<span class="hidden-xs"><?php echo ($__MEMBER__["name"]); ?></span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="<?php echo (get_cover($__MEMBER__["avatar"],'avatar')); ?>" class="img-circle" alt="User Image">
										<p>
											<?php echo ($__MEMBER__["name"]); ?> - Web Developer
											<small>上次登录IP(<?php echo (long2ip($__MEMBER__["last_login_ip"])); ?>)</small>
											<small>上次登录时间(<?php echo (date('Y-m-d H:i:s',$__MEMBER__["last_login_time"])); ?>)</small>
										</p>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">个人资料</a>
										</div>
										<div class="pull-right">
											<a href="<?php echo U('Public/logout');?>" class="btn btn-default btn-flat ajax-get">退出</a>
										</div>
									</li>
								</ul>
							</li>
							<!-- 删除缓存 -->
							<li>
								<a href="<?php echo U('Mng/Index/rmdirr');?>" class="ajax-get">
									<i class="fa fa-trash"></i>
									<span class="hidden-xs">清空缓存</span>
								</a>
							</li>
							<!-- Control Sidebar Toggle Button -->
							<li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							</li>
						</ul>
					</div>
				</nav>
			</header>

			
    <div class="container">
    	<br />
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="update pull-right"></div>
                        <i class="fa fa-cog"></i> 系统信息
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed text-overflow">
                            <tbody>
                                <tr>
                                    <td>当前版本</td>
                                    <td>v<?php echo C('CURRENT_VERSION');?></td>
                                </tr>
                                <tr>
                                    <td>ThinkPHP版本</td>
                                    <td><?php echo (THINK_VERSION); ?></td>
                                </tr>
                                <tr>
                                    <td>服务器操作系统</td>
                                    <td><?php echo (PHP_OS); ?></td>
                                </tr>
                                <tr>
                                    <td>运行环境</td>
                                    <td>
                                        <?php
 $server_software = explode(' ', $_SERVER['SERVER_SOFTWARE']); echo $server_software[0]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PHP版本</td>
                                    <td><?php echo PHP_VERSION; ?></td>
                                </tr>
                                <tr>
                                    <td>MYSQL版本</td>
                                    <td><?php $system_info_mysql = M()->query("select version() as v;"); echo ($system_info_mysql["0"]["v"]); ?></td>
                                </tr>
                                <tr>
                                    <td>上传限制</td>
                                    <td><?php echo ini_get('upload_max_filesize');?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 


			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark"></aside>
			<!-- /.control-sidebar -->
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<!-- jQuery UI 1.11.4 -->
		<script src="/Public/AdminLTE2/plugins/jQueryUI/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.5 -->
		<script src="/Public/AdminLTE2/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!-- Slimscroll -->
		<script src="/Public/AdminLTE2/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="/Public/AdminLTE2/plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="/Public/AdminLTE2/dist/js/app.min.js"></script>
		<!-- Common -->
		<script src="/Public/Admin/js/common.js"></script>
		<!-- -->
		
	</body>

</html>