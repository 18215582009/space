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
		
	<link href="/Public/Admin/css/builder.css" rel="stylesheet">


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

			
				<!-- Left side column. contains the logo and sidebar -->
				<aside class="main-sidebar">
					<!-- sidebar: style can be found in sidebar.less -->
					<section class="sidebar">
						<!-- Sidebar user panel -->
						<div class="user-panel">
							<div class="pull-left image">
								<img src="<?php echo (get_cover($__MEMBER__["avatar"],'avatar')); ?>" class="img-circle" alt="User Image">
							</div>
							<div class="pull-left info">
								<p><?php echo ($__MEMBER__["name"]); ?></p>
								<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
							</div>
						</div>
						<!-- search form -->
						<!--<form action="#" method="get" class="sidebar-form">
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
									<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
								</span>							
							</div>
						</form>-->
						<!-- /.search form -->
						<!-- sidebar menu: : style can be found in sidebar.less -->
						<ul class="sidebar-menu">
							<li class="header">SIDE NAVIGATION</li>
							<?php if(is_array($__SIDE_MENU_LIST__)): $i = 0; $__LIST__ = $__SIDE_MENU_LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="treeview <?php if(in_array($vo['id'], $__PARENT_MENU_ID__)) echo 'active'; ?>">
									<a href="javasrcipt:;"><i class="<?php echo ($vo["icon"]); ?>"></i> <span><?php echo ($vo["title"]); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
									<ul class="treeview-menu">
										<?php if(is_array($vo["_child"])): $i = 0; $__LIST__ = $vo["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo_child): $mod = ($i % 2 );++$i;?><li class="<?php if(in_array($vo_child['id'], $__PARENT_MENU_ID__)) echo 'active'; ?>">
												<a href="<?php echo U($vo_child['url']);?>"><i class="<?php echo ($vo_child["icon"]); ?>"></i> <?php echo ($vo_child["title"]); ?></a>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<!--<li class="header">LABELS</li>
							<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
							<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
							<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
						</ul>
					</section>
					<!-- /.sidebar -->
				</aside>

				<!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
					<!-- Content Header (Page header) -->
					<section class="content-header">
						<h1><?php echo ($meta_title); ?></h1>
						<ol class="breadcrumb">
							<?php if(is_array($__PARENT_MENU__)): $i = 0; $__LIST__ = $__PARENT_MENU__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php if(($i) == "1"): ?><i class="fa fa-dashboard"></i><?php endif; ?> <?php echo ($vo["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ol>
					</section>

					<!-- Main content -->
					<section class="content">
						
    <div class="builder builder-list-box">

    <!-- Tab导航 -->
    <?php if(!empty($tab_nav)): ?><div class="builder-tabs builder-list-tabs">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <?php if(is_array($tab_nav["tab_list"])): $i = 0; $__LIST__ = $tab_nav["tab_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li class="<?php if($tab_nav['current_tab'] == $key) echo 'active'; ?>"><a href="<?php echo ($tab["href"]); ?>"><?php echo ($tab["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div><?php endif; ?>

    <!-- 顶部工具栏按钮 -->
    <?php if(!empty($top_button_list)): ?><div class="builder-toolbar builder-list-toolbar">
            <div class="row">
                <!-- 工具栏按钮 -->
                <?php if(!empty($top_button_list)): ?><div class="col-xs-12 col-sm-9 button-list">
                        <?php if(is_array($top_button_list)): $i = 0; $__LIST__ = $top_button_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$button): $mod = ($i % 2 );++$i;?><a <?php echo ($button["attribute"]); ?>><?php echo ($button["title"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                    </div><?php endif; ?>

                <!-- 搜索框 -->
                <?php if(!empty($search)): ?><div class="col-xs-12 col-sm-3">
                        <div class="input-group search-form">
                            <input type="text" name="keyword" class="search-input form-control" value="<?php echo ($_GET["keyword"]); ?>" placeholder="<?php echo ($search["title"]); ?>">
                            <span class="input-group-btn"><a class="btn btn-default" href="javascript:;" id="search" url="<?php echo ($search["url"]); ?>"><i class="fa fa-search"></i></a></span>
                        </div>
                    </div><?php endif; ?>
            </div>
        </div><?php endif; ?>


    <!-- 数据列表 -->
    <div class="builder-container builder-list-container">
        <div class="row">
            <div class="col-xs-12">

                <div class="builder-table">
                    <div class="panel panel-default">
                        <table class="table table-bordered table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><input class="check-all" type="checkbox"></th>
                                    <?php if(is_array($table_column_list)): $i = 0; $__LIST__ = $table_column_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$column): $mod = ($i % 2 );++$i;?><th><?php echo (htmlspecialchars($column["title"])); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($table_data_list)): $i = 0; $__LIST__ = $table_data_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                        <td><input class="ids" type="checkbox" value="<?php echo ($data[$table_data_list_key]); ?>" name="ids[]"></td>
                                        <?php if(is_array($table_column_list)): $i = 0; $__LIST__ = $table_column_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$column): $mod = ($i % 2 );++$i;?><td><?php echo ($data[$column['name']]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                <?php if(empty($table_data_list)): ?><tr class="builder-data-empty">
                                        <?php $tdcolspan = count($table_column_list)+1 ?>
                                        <td class="text-center empty-info" colspan="<?php echo ($tdcolspan); ?>">
                                            <i class="fa fa-database"></i> 暂时没有数据<br>
                                            <span class="small">本系统由 <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank"><?php echo C('PRODUCT_NAME');?></a> v<?php echo C('CURRENT_VERSION');?> 强力驱动</span>
                                        </td>
                                    </tr><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if(!empty($table_data_page)): ?><ul class="pagination"><?php echo ($table_data_page); ?></ul><?php endif; ?>
                </div>

            </div>
        </div>
    </div>


    <!-- 额外功能代码 -->
    <?php echo ($extra_html); ?>
</div>


					</section>
					<!-- /.content -->
				</div>
				<!-- /.content-wrapper -->
				<footer class="main-footer">
					<div class="pull-right hidden-xs">
						<b>Version</b> <?php echo C('CURRENT_VERSION');?>
					</div>
					<strong>Copyright &copy; 2014-<?php echo time_format('', 'Y');?> <a href="<?php echo C('WEBSITE_DOMAIN');?>" target="_blank"><?php echo C('PRODUCT_NAME');?></a>.</strong> All rights reserved.
				</footer>
			

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
		
	<script src="/Public/Admin/js/builder.js"></script>

	</body>

</html>