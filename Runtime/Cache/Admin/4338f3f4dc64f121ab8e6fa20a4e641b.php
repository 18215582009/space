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
	<link href="/Public/Libs/jquery_huploadify/Huploadify.css" rel="stylesheet" />
	<link href="/Public/Libs/bootstrap_daterangepicker/daterangepicker.css" rel="stylesheet" />	


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
						
    <div class="builder builder-form-box">
    <?php if(!empty($tab_nav)): ?><div class="builder-tabs builder-form-tabs">
            <ul class="nav nav-tabs">
                <?php if(is_array($tab_nav["tab_list"])): $i = 0; $__LIST__ = $tab_nav["tab_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li class="<?php if($tab_nav['current_tab'] == $key) echo 'active'; ?>"><a href="<?php echo ($tab["href"]); ?>"><?php echo ($tab["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div><?php endif; ?>

    
    <div class="builder-container builder-form-container">
        <div class="row">
            <div class="col-xs-12">
                <form action="<?php echo ($post_url); ?>" method="post" class="form builder-form">
                    <?php if(is_array($form_items)): $k = 0; $__LIST__ = $form_items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$form): $mod = ($k % 2 );++$k;?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra_class"]); ?>">
                            <?php if($form['type'] != 'group' && $form['type'] != 'hidden'): ?>
                                <label class="item-label"><?php echo ($form["title"]); if(!empty($form["tip"])): ?><span class="check-tips">（<span class="small"><?php echo ($form["tip"]); ?></span>）</span><?php endif; ?></label>
                            <?php endif; ?>
                            <div class="controls">

                                <?php switch($form["type"]): case "hidden": ?><input type="hidden" class="form-control input" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra_attr"]); ?>><?php break;?>
                                    
                                    <?php case "num": ?><input type="text" class="form-control input num" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra_attr"]); ?>><?php break;?>
                                    
                                    <?php case "text": ?><input type="text" class="form-control input text" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra_attr"]); ?>><?php break;?>
                                    
                                    <?php case "textarea": ?><textarea class="form-control textarea" rows="5" name="<?php echo ($form["name"]); ?>" <?php echo ($form["extra_attr"]); ?>><?php echo ($form["value"]); ?></textarea><?php break;?>
                                    
                                    <?php case "array": ?><textarea class="form-control textarea" rows="5" name="<?php echo ($form["name"]); ?>" <?php echo ($form["extra_attr"]); ?>><?php echo ($form["value"]); ?></textarea><?php break;?>
                                    
                                    <?php case "password": ?><input type="password" class="form-control input password" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra_attr"]); ?>><?php break;?>
                                    
                                    <?php case "radio": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><label class="radio-inline" for="<?php echo ($form["name"]); echo ($option_key); ?>">
            <?php if(is_array($option)): ?>
                <input type="radio" id="<?php echo ($form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($form["extra_attr"]); ?>
                    <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                <?php echo ($option["title"]); ?>
            <?php else: ?>
                <input type="radio" id="<?php echo ($form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($form["extra_attr"]); ?>> <?php echo ($option); ?>
            <?php endif; ?>
        </label><?php endforeach; endif; break;?>
                                    
                                    <?php case "checkbox": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <?php if(!empty($form["value"])): if(is_string($form['value'])){ $form['value'] = explode(',', $form['value']); } endif; ?>
    <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><label class="checkbox-inline">
            <?php if(is_array($option)): ?>
                <input type="checkbox" name="<?php echo ($form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?> <?php echo ($form["extra_attr"]); ?>
                    <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                <?php echo ($option["title"]); ?>
            <?php else: ?>
                <input type="checkbox" name="<?php echo ($form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?> <?php echo ($form["extra_attr"]); ?>><?php echo ($option); ?>
            <?php endif; ?>
        </label><?php endforeach; endif; break;?>
                                    
                                    <?php case "select": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <select name="<?php echo ($form["name"]); ?>" class="form-control select" <?php echo ($form["extra_attr"]); ?>>
        <option value=''>请选择：</option>
        <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): if(is_array($option)): ?>
                <option value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>selected<?php endif; ?>
                    <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                    <?php echo ($option["title"]); ?>
                </option>
            <?php else: ?>
                <option value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>selected<?php endif; ?>><?php echo ($option); ?></option>
            <?php endif; endforeach; endif; ?>
    </select><?php break;?>
                                    
                                    <?php case "icon": ?><input type="text" id="<?php echo ($group_k); ?>_icon_<?php echo ($k); ?>" class="form-control input icon-choosen" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            $("#<?php echo ($group_k); ?>_icon_<?php echo ($k); ?>").iconChoosen({});
        });
    </script><?php break;?>

                                    
                                    <?php case "date": ?><input type="text" id="<?php echo ($group_k); ?>_date_<?php echo ($k); ?>" class="form-control input date" name="<?php echo ($form["name"]); ?>" value="<?php if(!empty($form["value"])): echo (time_format($form["value"],'Y-m-d')); endif; ?>" <?php echo ($form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            $("#<?php echo ($group_k); ?>_date_<?php echo ($k); ?>").daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "确定",
                    "cancelLabel": "取消",
                    "fromLabel": "开始",
                    "toLabel": "结束",
                    "customRangeLabel": "自定义",
                    "daysOfWeek": ['日', '一', '二', '三', '四', '五', '六'],
                    "monthNames": ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                    "firstDay": 1
                }
            });
        });
    </script><?php break;?>
                                    
                                    <?php case "time": ?><input type="text" id="<?php echo ($group_k); ?>_time_<?php echo ($k); ?>" class="form-control input time" name="<?php echo ($form["name"]); ?>" value="<?php if(!empty($form["value"])): echo (time_format($form["value"])); endif; ?>" <?php echo ($form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            $("#<?php echo ($group_k); ?>_time_<?php echo ($k); ?>").daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "timePicker": true,
                "timePickerIncrement": 1,
                "locale": {
                    "format": "YYYY-MM-DD h:mm",
                    "separator": " - ",
                    "applyLabel": "确定",
                    "cancelLabel": "取消",
                    "fromLabel": "开始",
                    "toLabel": "结束",
                    "customRangeLabel": "自定义",
                    "daysOfWeek": ['日', '一', '二', '三', '四', '五', '六'],
                    "monthNames": ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                    "firstDay": 1
                }

            });
        });
    </script><?php break;?>
                                    
                                    <?php case "picture": ?><div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" <?php echo ($form["extra_attr"]); ?>></div>
    <div id="<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>">
        <input type="hidden" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
        <?php if(!empty($form["value"])): ?><span class="img-box">
                <img class="img" src="<?php echo (get_cover($form["value"])); ?>" data-id="<?php echo ($form["value"]); ?>">
                <i class="fa fa-times-circle remove-picture"></i>
            </span><?php endif; ?>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;*.bmp',
                fileSizeLimit:<?php echo C('UPLOAD_IMAGE_SIZE');?>*1024,
                buttonText:'上传图片',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var new_img = '<span class="img-box"><img class="img" src="' + data.url + '" data-id="'+data.id+'"><i class="fa fa-times-circle remove-picture"></i></span>';
                        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>').append(new_img);
                        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').attr('value', data.id);
                    }
                }
            });
        });
        //删除图片
        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>').on('click', '.remove-picture', function(){
            var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
            if(!ready_for_remove_id){
                $.alertMessager('错误', 'danger');
            }
            $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').val('') //删除后覆盖原input的值为空
            $(this).closest('.img-box').remove(); //删除图片预览图
        });
    </script><?php break;?>
                                    
                                    <?php case "pictures": ?><div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" <?php echo ($form["extra_attr"]); ?>></div>
    <div id="<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>">
        <input type="hidden" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
        <?php if(!empty($form["value"])): $images = explode(',',$form['value']); ?>
            <?php if(is_array($images)): foreach($images as $key=>$img): ?><span class="img-box"><img class="img" src="<?php echo (get_cover($img)); ?>" data-id="<?php echo ($img); ?>"><i class="fa fa-times-circle remove-picture"></i></span><?php endforeach; endif; endif; ?>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;*.bmp',
                fileSizeLimit:<?php echo C('UPLOAD_IMAGE_SIZE');?>*1024,
                buttonText:'上传图片',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var input = $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input');
                        var new_img = '<span class="img-box"><img class="img" src="' + data.url + '" data-id="'+data.id+'"><i class="fa fa-times-circle remove-picture"></i></span>';
                        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>').append(new_img);
                        if(input.val()){
                            input.val(input.val() + ',' + data.id);
                        }else{
                            input.val(data.id);
                        }
                    }
                }
            });
            //删除图片
            $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> .remove-picture').click(function(){
                var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
                if(!ready_for_remove_id){
                    $.alertMessager('错误', 'danger');
                }
                var current_picture_ids = $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').val().split(","); //获取当前图集以逗号分隔的ID并转换成数组
                current_picture_ids.remove(ready_for_remove_id); //从数组中删除待删除的图片ID
                $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').val(current_picture_ids.join(',')) //删除后覆盖原input的值
                $(this).closest('.img-box').remove(); //删除图片预览图
            });
        });
    </script><?php break;?>
                                    
                                    <?php case "file": ?><div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" <?php echo ($form["extra_attr"]); ?>></div>
    <div id="<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>">
        <input type="hidden" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
        <ul class="list-group file-box">
            <?php if(!empty($form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                    <i class="fa fa-file"></i> 
                    <span><?php echo (get_upload_info($form["value"],'name')); ?></span>
                    <i class="fa fa-times-circle remove-file"></i>
                </li><?php endif; ?>
        </ul>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;'+
                             '*.swf;*.flv;*.mp3;*.wav;*.wma;*.wmv;*.mid;*.avi;*.mpg;*.asf;*.rm;*.rmvb;*.mp4;'+
                             '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.wps;*.txt;*.zip;*.rar;*.gz;*.bz2;*.7z',
                fileSizeLimit:<?php echo C('UPLOAD_FILE_SIZE');?>*1024,
                buttonText:'上传文件',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var new_file = '<li class="list-group-item file-item" data-id="'+data.id+'"><i class="fa fa-file"></i> '
                                       +data.name+' <i class="fa fa-times-circle remove-file"></i></li>'
                        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> .list-group').html(new_file);
                        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').attr('value', data.id);
                    }
                }
            });
        });
        //删除文件
        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> .remove-file').click(function(){
            var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
            if(!ready_for_remove_id) {
                $.alertMessager('错误', 'danger');
            }
            $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').val('') //删除后覆盖原input的值为空
            $(this).closest('.file-item').remove(); //删除文件预览
        });
    </script><?php break;?>
                                    
                                    <?php case "files": ?><div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" <?php echo ($form["extra_attr"]); ?>></div>
    <div id="<?php echo ($group_k); ?>_preview_<?php echo ($k); ?>">
        <input type="hidden" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
        <ul class="list-group file-box">
            <?php if(!empty($form["value"])): $files = explode(',',$form['value']); ?>
                <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                        <i class="fa fa-file"></i> 
                        <span><?php echo (get_upload_info($file,'name')); ?></span> 
                        <i class="fa fa-times-circle remove-file"></i>
                    </li><?php endforeach; endif; endif; ?>
        </ul>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;'+
                             '*.swf;*.flv;*.mp3;*.wav;*.wma;*.wmv;*.mid;*.avi;*.mpg;*.asf;*.rm;*.rmvb;*.mp4;'+
                             '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.wps;*.txt;*.zip;*.rar;*.gz;*.bz2;*.7z',
                fileSizeLimit:<?php echo C('UPLOAD_FILE_SIZE');?>*1024,
                buttonText:'添加文件',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var new_file = '<li class="list-group-item file-item" data-id="'+data.id+'"><i class="fa fa-file"></i> '
                                       +data.name+' <i class="fa fa-times-circle remove-file"></i></li>'
                        $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> .list-group').append(new_file);
                        var input = $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input');
                        if(input.val() != ''){
                            input.val(input.val() + ',' + data.id);
                        }else{
                            input.val(data.id);
                        }
                    }
                }
            });
            //删除文件
            $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> .remove-file').click(function(){
                var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                if(!ready_for_remove_id) {
                    $.alertMessager('错误', 'danger');
                }
                var current_file_ids = $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                $('#<?php echo ($group_k); ?>_preview_<?php echo ($k); ?> input').val(current_file_ids.join(',')) //删除后覆盖原input的值
                $(this).closest('.file-item').remove(); //删除文件预览
            });
        });
    </script><?php break;?>
                                    
                                    <?php case "kindeditor": ?><textarea name="<?php echo ($form["name"]); ?>" id="<?php echo ($group_k); ?>_kindeditor_<?php echo ($k); ?>" class="form-control" <?php echo ($form["extra_attr"]); ?>>
        <?php echo ($form["value"]); ?>
    </textarea>
    <script type="text/javascript" src="/Public/libs/kindeditor/kindeditor-min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(function(){
            KindEditor.ready(function(K) {
                kindeditor_<?php echo ($k); ?> = K.create('#<?php echo ($group_k); ?>_kindeditor_<?php echo ($k); ?>', {
                    allowFileManager : true,
                    filePostName : 'file',
                    width : '100%',
                    height : '500px',
                    cssPath : [
                        '/Public/libs/bootstrap/dist/css/bootstrap.min.css',
                        '/Public/libs/kindeditor/plugins/code/prettify.css'
                    ],
                    resizeType: 1,
                    pasteType : 2,
                    urlType : 'absolute',
                    fileManagerJson : '<?php echo U(C("MODULE_MARK")."/PublicUpload/fileManager");?>',
                    uploadJson : '<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                    remoteImgSaveUrl: '<?php echo U(C("MODULE_MARK")."/PublicUpload/downremoteimg");?>',
                    extraFileUploadParams: {
                        session_id : '<?php echo session_id();?>'
                    },
                    afterBlur: function(){this.sync();},
                    autoSaveMode:true,
                    autoSaveInterval:100,
                    afterCreate: function() {
                        this.loadPlugin('autosave');
                    }
                });
            });
        });
    </script><?php break;?>
                                    
                                    <?php case "simditor": ?><textarea name="<?php echo ($form["name"]); ?>" id="<?php echo ($group_k); ?>_simditor_<?php echo ($k); ?>" class="form-control" <?php echo ($form["extra_attr"]); ?>>
        <?php echo ($form["value"]); ?>
    </textarea>

    <link rel="stylesheet" type="text/css" href="/Public/libs/simditor/styles/simditor.css">
    <script type="text/javascript" src="/Public/libs/simditor/scripts/module.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor/scripts/uploader.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor/scripts/simditor.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/libs/simditor_markdown/styles/simditor-markdown.css">
    <script type="text/javascript" src="/Public/libs/marked/marked.min.js"></script>
    <script type="text/javascript" src="/Public/libs/to_markdown/dist/to-markdown.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor_markdown/lib/simditor-markdown.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/libs/simditor_html/styles/simditor-html.css">
    <script type="text/javascript" src="/Public/libs/js_beautify/js/lib/beautify-html.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor_html/lib/simditor-html.js"></script>


    <script type="text/javascript">
        var editor = new Simditor({
          textarea: $('#<?php echo ($group_k); ?>_simditor_<?php echo ($k); ?>'),
          toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', '|', 'markdown', 'html']
        });
    </script><?php break;?>
                                    
                                    <?php case "tags": ?><input type="text" id="<?php echo ($group_k); ?>_tag_<?php echo ($k); ?>" class="form-control" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            //标签自动完成
            var tags = $('#<?php echo ($group_k); ?>_tag_<?php echo ($k); ?>'), tagsPre = [];
            if (tags.length > 0) {
                var items = tags.val().split(','), result = [];
                for (var i = 0; i < items.length; i ++) {
                    var tag = items[i];
                    if (!tag) {
                        continue;
                    }
                    tagsPre.push({
                        id      :   tag,
                        title   :   tag
                    });
                }
            }
            tags.tokenInput('<?php echo U(C("MODULE_MARK")."/Tag/searchTags");?>',{
                propertyToSearch    :   'title',
                tokenValue          :   'title',
                theme               :   'bootstrap',
                searchDelay         :   0,
                tokenLimit          :   5,
                preventDuplicates   :   true,
                animateDropdown     :   true,
                allowFreeTagging    :   true,
                hintText            :   '请输入标签名',
                noResultsText       :   '此标签不存在, 按回车创建',
                searchingText       :   "查找中...",
                prePopulate         :   tagsPre,
                onAdd: function (item){ //新增系统没有的标签时提交到数据库
                    $.post('<?php echo U(C("MODULE_MARK")."/Tag/add");?>', {'title': item.title});
                }
            });
        });
    </script><?php break;?>
                                    
                                    <?php case "board": ?><input type="hidden" name="<?php echo ($form["name"]); ?>" value='<?php echo ($form["value"]); ?>'>
    <div class="row board_list boards_<?php echo ($k); ?>" <?php echo ($form["extra_attr"]); ?>>
        <div class="container-fluid">
            <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="panel panel-default board col-xs-12 col-sm-3" data-id="<?php echo ($option_key); ?>">
                    <div class="panel-heading">
                        <strong><?php echo ($option["title"]); ?></strong>
                    </div>
                    <div class="list-group dragsort_<?php echo ($k); ?>" data-group="<?php echo ($option_key); ?>">
                        <?php if(is_array($option["field"])): foreach($option["field"] as $option_field_key=>$option_field): ?><div class="list-group-item">
                                <em data="<?php echo ($field['id']); ?>"><?php echo ($option_field); ?></em>
                                <input type="hidden" name="<?php echo ($form["name"]); ?>[<?php echo ($option_key); ?>][]" value="<?php echo ($option_field_key); ?>"/>
                            </div><?php endforeach; endif; ?>
                    </div>
                </div><?php endforeach; endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        //拖曳插件初始化
        $(function(){
            $(".dragsort_<?php echo ($k); ?>").dragsort({
                 dragSelector:'div',
                 placeHolderTemplate: '<div class="clearfix draging-place">&nbsp;</div>',
                 dragBetween:true, //允许拖动到任意地方
                 dragEnd:function(){
                     var self = $(this);
                     self.find('input').attr('name', '<?php echo ($form["name"]); ?>[' + self.closest('.dragsort_<?php echo ($k); ?>').data('group') + '][]');
                 }
             });
        });
    </script><?php break;?>

                                    <?php case "group": ?><div class="builder-tabs builder-form-tabs">
                                            <ul class="nav nav-tabs">
                                                <?php if(is_array($form["options"])): $group_k = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($group_k % 2 );++$group_k;?><li data-tab="tab<?php echo ($group_k); ?>" <?php if(($group_k) == "1"): ?>class="active"<?php endif; ?>><a href="#tab<?php echo ($group_k); ?>" data-toggle="tab"><?php echo ($li["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </ul>
                                        </div>

                                        <div class="builder-container builder-form-container">
                                            <div class="tab-content">
                                                <?php if(is_array($form["options"])): $group_k = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($group_k % 2 );++$group_k;?><div id="tab<?php echo ($group_k); ?>" class='tab-pane <?php if(($group_k) == "1"): ?>active<?php endif; ?> tab<?php echo ($group_k); ?>'>
                                                        <div class="controls">
                                                            <?php if(is_array($tab["options"])): $tab_k = 0; $__LIST__ = $tab["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab_form): $mod = ($tab_k % 2 );++$tab_k;?><div class="form-group <?php echo ($tab_form["extra_class"]); ?>">
                                                                    <label class="item-label"><?php echo ($tab_form["title"]); if(!empty($tab_form["tip"])): ?><span class="check-tips">（<?php echo ($tab_form["tip"]); ?>）</span><?php endif; ?></label>
                                                                    <div class="controls">

                                                                        <?php switch($tab_form["type"]): case "hidden": ?><input type="hidden" class="form-control input" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>><?php break;?>
                                                                            
                                                                            <?php case "num": ?><input type="text" class="form-control input num" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>><?php break;?>
                                                                            
                                                                            <?php case "text": ?><input type="text" class="form-control input text" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>><?php break;?>
                                                                            
                                                                            <?php case "textarea": ?><textarea class="form-control textarea" rows="5" name="<?php echo ($tab_form["name"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>><?php echo ($tab_form["value"]); ?></textarea><?php break;?>
                                                                            
                                                                            <?php case "array": ?><textarea class="form-control textarea" rows="5" name="<?php echo ($tab_form["name"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>><?php echo ($tab_form["value"]); ?></textarea><?php break;?>
                                                                            
                                                                            <?php case "password": ?><input type="password" class="form-control input password" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>><?php break;?>
                                                                            
                                                                            <?php case "radio": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): ?><label class="radio-inline" for="<?php echo ($tab_form["name"]); echo ($option_key); ?>">
            <?php if(is_array($option)): ?>
                <input type="radio" id="<?php echo ($tab_form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($tab_form["extra_attr"]); ?>
                    <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                <?php echo ($option["title"]); ?>
            <?php else: ?>
                <input type="radio" id="<?php echo ($tab_form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($tab_form["extra_attr"]); ?>> <?php echo ($option); ?>
            <?php endif; ?>
        </label><?php endforeach; endif; break;?>
                                                                            
                                                                            <?php case "checkbox": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <?php if(!empty($tab_form["value"])): if(is_string($tab_form['value'])){ $tab_form['value'] = explode(',', $tab_form['value']); } endif; ?>
    <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): ?><label class="checkbox-inline">
            <?php if(is_array($option)): ?>
                <input type="checkbox" name="<?php echo ($tab_form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?> <?php echo ($tab_form["extra_attr"]); ?>
                    <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                <?php echo ($option["title"]); ?>
            <?php else: ?>
                <input type="checkbox" name="<?php echo ($tab_form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?> <?php echo ($tab_form["extra_attr"]); ?>><?php echo ($option); ?>
            <?php endif; ?>
        </label><?php endforeach; endif; break;?>
                                                                            
                                                                            <?php case "select": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <select name="<?php echo ($tab_form["name"]); ?>" class="form-control select" <?php echo ($tab_form["extra_attr"]); ?>>
        <option value=''>请选择：</option>
        <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): if(is_array($option)): ?>
                <option value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>selected<?php endif; ?>
                    <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                    <?php echo ($option["title"]); ?>
                </option>
            <?php else: ?>
                <option value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>selected<?php endif; ?>><?php echo ($option); ?></option>
            <?php endif; endforeach; endif; ?>
    </select><?php break;?>
                                                                            
                                                                            <?php case "icon": ?><input type="text" id="tab_<?php echo ($group_k); ?>_icon_<?php echo ($tab_k); ?>" class="form-control input icon-choosen" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            $("#tab_<?php echo ($group_k); ?>_icon_<?php echo ($tab_k); ?>").iconChoosen({});
        });
    </script><?php break;?>

                                                                            
                                                                            <?php case "date": ?><input type="text" id="tab_<?php echo ($group_k); ?>_date_<?php echo ($tab_k); ?>" class="form-control input date" name="<?php echo ($tab_form["name"]); ?>" value="<?php if(!empty($tab_form["value"])): echo (time_format($tab_form["value"],'Y-m-d')); endif; ?>" <?php echo ($tab_form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            $("#tab_<?php echo ($group_k); ?>_date_<?php echo ($tab_k); ?>").daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "确定",
                    "cancelLabel": "取消",
                    "fromLabel": "开始",
                    "toLabel": "结束",
                    "customRangeLabel": "自定义",
                    "daysOfWeek": ['日', '一', '二', '三', '四', '五', '六'],
                    "monthNames": ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                    "firstDay": 1
                }
            });
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "time": ?><input type="text" id="tab_<?php echo ($group_k); ?>_time_<?php echo ($tab_k); ?>" class="form-control input time" name="<?php echo ($tab_form["name"]); ?>" value="<?php if(!empty($tab_form["value"])): echo (time_format($tab_form["value"])); endif; ?>" <?php echo ($tab_form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            $("#tab_<?php echo ($group_k); ?>_time_<?php echo ($tab_k); ?>").daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "timePicker": true,
                "timePickerIncrement": 1,
                "locale": {
                    "format": "YYYY-MM-DD h:mm",
                    "separator": " - ",
                    "applyLabel": "确定",
                    "cancelLabel": "取消",
                    "fromLabel": "开始",
                    "toLabel": "结束",
                    "customRangeLabel": "自定义",
                    "daysOfWeek": ['日', '一', '二', '三', '四', '五', '六'],
                    "monthNames": ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                    "firstDay": 1
                }

            });
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "picture": ?><div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" <?php echo ($form["extra_attr"]); ?>></div>
    <div id="tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>">
        <input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
        <?php if(!empty($tab_form["value"])): ?><span class="img-box">
                <img class="img" src="<?php echo (get_cover($tab_form["value"])); ?>" data-id="<?php echo ($tab_form["value"]); ?>">
                <i class="fa fa-times-circle remove-picture"></i>
            </span><?php endif; ?>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;*.bmp',
                fileSizeLimit:<?php echo C('UPLOAD_IMAGE_SIZE');?>*1024,
                buttonText:'上传图片',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var new_img = '<span class="img-box"><img class="img" src="' + data.url + '" data-id="'+data.id+'"><i class="fa fa-times-circle remove-picture"></i></span>';
                        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>').append(new_img);
                        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').attr('value', data.id);
                    }
                }
            });
        });
        //删除图片
        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>').on('click', '.remove-picture', function(){
            var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
            if(!ready_for_remove_id){
                $.alertMessager('错误', 'danger');
            }
            $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').val('') //删除后覆盖原input的值为空
            $(this).closest('.img-box').remove(); //删除图片预览图
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "pictures": ?><div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" <?php echo ($tab_form["extra_attr"]); ?>></div>
    <div id="tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>">
        <input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
        <?php if(!empty($tab_form["value"])): $images = explode(',',$tab_form['value']); ?>
            <?php if(is_array($images)): foreach($images as $key=>$img): ?><span class="img-box"><img class="img" src="<?php echo (get_cover($img)); ?>" data-id="<?php echo ($img); ?>"><i class="fa fa-times-circle remove-picture"></i></span><?php endforeach; endif; endif; ?>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;*.bmp',
                fileSizeLimit:<?php echo C('UPLOAD_IMAGE_SIZE');?>*1024,
                buttonText:'上传图片',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var input = $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input');
                        var new_img = '<span class="img-box"><img class="img" src="' + data.url + '" data-id="'+data.id+'"><i class="fa fa-times-circle remove-picture"></i></span>';
                        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>').append(new_img);
                        if(input.val()){
                            input.val(input.val() + ',' + data.id);
                        }else{
                            input.val(data.id);
                        }
                    }
                }
            });
            //删除图片
            $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> .remove-picture').click(function(){
                var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
                if(!ready_for_remove_id){
                    $.alertMessager('错误', 'danger');
                }
                var current_picture_ids = $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').val().split(","); //获取当前图集以逗号分隔的ID并转换成数组
                current_picture_ids.remove(ready_for_remove_id); //从数组中删除待删除的图片ID
                $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').val(current_picture_ids.join(',')) //删除后覆盖原input的值
                $(this).closest('.img-box').remove(); //删除图片预览图
            });
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "file": ?><div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" <?php echo ($form["extra_attr"]); ?>></div>
    <div id="tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>">
        <input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
        <ul class="list-group file-box">
            <?php if(!empty($tab_form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                    <i class="fa fa-file"></i> 
                    <span><?php echo (get_upload_info($tab_form["value"],'name')); ?></span>
                    <i class="fa fa-times-circle remove-file"></i>
                </li><?php endif; ?>
        </ul>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;'+
                             '*.swf;*.flv;*.mp3;*.wav;*.wma;*.wmv;*.mid;*.avi;*.mpg;*.asf;*.rm;*.rmvb;*.mp4;'+
                             '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.wps;*.txt;*.zip;*.rar;*.gz;*.bz2;*.7z',
                fileSizeLimit:<?php echo C('UPLOAD_FILE_SIZE');?>*1024,
                buttonText:'上传文件',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var new_file = '<li class="list-group-item file-item" data-id="'+data.id+'"><i class="fa fa-file"></i> '
                                       +data.name+' <i class="fa fa-times-circle remove-file"></i></li>'
                        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> .list-group').html(new_file);
                        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').attr('value', data.id);
                    }
                }
            });
        });
        //删除文件
        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> .remove-file').click(function(){
            var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
            if(!ready_for_remove_id) {
                $.alertMessager('错误', 'danger');
            }
            $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').val('') //删除后覆盖原input的值为空
            $(this).closest('.file-item').remove(); //删除文件预览
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "files": ?><div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" <?php echo ($tab_form["extra_attr"]); ?>></div>
    <div id="tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?>">
        <input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
        <ul class="list-group file-box">
            <?php if(!empty($tab_form["value"])): $files = explode(',',$tab_form['value']); ?>
                <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                        <i class="fa fa-file"></i> 
                        <span><?php echo (get_upload_info($file,'name')); ?></span> 
                        <i class="fa fa-times-circle remove-file"></i>
                    </li><?php endforeach; endif; endif; ?>
        </ul>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>').Huploadify({
                uploader:'<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;'+
                             '*.swf;*.flv;*.mp3;*.wav;*.wma;*.wmv;*.mid;*.avi;*.mpg;*.asf;*.rm;*.rmvb;*.mp4;'+
                             '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.wps;*.txt;*.zip;*.rar;*.gz;*.bz2;*.7z',
                fileSizeLimit:<?php echo C('UPLOAD_FILE_SIZE');?>*1024,
                buttonText:'添加文件',
                onUploadComplete:function(file, data){
                    var data = $.parseJSON(data);
                    if(data.error == 1){
                        $.alertMessager(data.message, 'danger');
                    }else{
                        var new_file = '<li class="list-group-item file-item" data-id="'+data.id+'"><i class="fa fa-file"></i> '
                                       +data.name+' <i class="fa fa-times-circle remove-file"></i></li>'
                        $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> .list-group').append(new_file);
                        var input = $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input');
                        if(input.val() != ''){
                            input.val(input.val() + ',' + data.id);
                        }else{
                            input.val(data.id);
                        }
                    }
                }
            });
            //删除文件
            $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> .remove-file').click(function(){
                var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                if(!ready_for_remove_id) {
                    $.alertMessager('错误', 'danger');
                }
                var current_file_ids = $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                $('#tab_<?php echo ($group_k); ?>_preview_<?php echo ($tab_k); ?> input').val(current_file_ids.join(',')) //删除后覆盖原input的值
                $(this).closest('.file-item').remove(); //删除文件预览
            });
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "kindeditor": ?><textarea name="<?php echo ($tab_form["name"]); ?>" id="tab_<?php echo ($group_k); ?>_kindeditor_<?php echo ($tab_k); ?>" class="form-control" <?php echo ($tab_form["extra_attr"]); ?>>
        <?php echo ($tab_form["value"]); ?>
    </textarea>
    <script type="text/javascript" src="/Public/libs/kindeditor/kindeditor-min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(function(){
            KindEditor.ready(function(K) {
                kindeditor_<?php echo ($tab_k); ?> = K.create('#tab_<?php echo ($group_k); ?>_kindeditor_<?php echo ($tab_k); ?>', {
                    allowFileManager : true,
                    filePostName : 'file',
                    width : '100%',
                    height : '500px',
                    cssPath : [
                        '/Public/libs/bootstrap/dist/css/bootstrap.min.css',
                        '/Public/libs/kindeditor/plugins/code/prettify.css'
                    ],
                    resizeType: 1,
                    pasteType : 2,
                    urlType : 'absolute',
                    fileManagerJson : '<?php echo U(C("MODULE_MARK")."/PublicUpload/fileManager");?>',
                    uploadJson : '<?php echo U(C("MODULE_MARK")."/PublicUpload/upload");?>',
                    remoteImgSaveUrl: '<?php echo U(C("MODULE_MARK")."/PublicUpload/downremoteimg");?>',
                    extraFileUploadParams: {
                        session_id : '<?php echo session_id();?>'
                    },
                    afterBlur: function(){this.sync();},
                    autoSaveMode:true,
                    autoSaveInterval:100,
                    afterCreate: function() {
                        this.loadPlugin('autosave');
                    }
                });
            });
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "simditor": ?><textarea name="<?php echo ($tab_form["name"]); ?>" id="tab_<?php echo ($group_k); ?>_simditor_<?php echo ($tab_k); ?>" class="form-control" <?php echo ($tab_form["extra_attr"]); ?>>
        <?php echo ($tab_form["value"]); ?>
    </textarea>

    <link rel="stylesheet" type="text/css" href="/Public/libs/simditor/styles/simditor.css">
    <script type="text/javascript" src="/Public/libs/simditor/scripts/module.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor/scripts/uploader.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor/scripts/simditor.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/libs/simditor_markdown/styles/simditor-markdown.css">
    <script type="text/javascript" src="/Public/libs/marked/marked.min.js"></script>
    <script type="text/javascript" src="/Public/libs/to_markdown/dist/to-markdown.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor_markdown/lib/simditor-markdown.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/libs/simditor_html/styles/simditor-html.css">
    <script type="text/javascript" src="/Public/libs/js_beautify/js/lib/beautify-html.js"></script>
    <script type="text/javascript" src="/Public/libs/simditor_html/lib/simditor-html.js"></script>


    <script type="text/javascript">
        var editor = new Simditor({
          textarea: $('#tab_<?php echo ($group_k); ?>_simditor_<?php echo ($tab_k); ?>'),
          toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', '|', 'markdown', 'html']
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "tags": ?><input type="text" id="tab_<?php echo ($group_k); ?>_tag_<?php echo ($tab_k); ?>" class="form-control" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra_attr"]); ?>>
    <script type="text/javascript">
        $(function(){
            //标签自动完成
            var tags = $('#tab_<?php echo ($group_k); ?>_tag_<?php echo ($tab_k); ?>'), tagsPre = [];
            if (tags.length > 0) {
                var items = tags.val().split(','), result = [];
                for (var i = 0; i < items.length; i ++) {
                    var tag = items[i];
                    if (!tag) {
                        continue;
                    }
                    tagsPre.push({
                        id      :   tag,
                        title   :   tag
                    });
                }
            }
            tags.tokenInput('<?php echo U(C("MODULE_MARK")."/Tag/searchTags");?>',{
                propertyToSearch    :   'title',
                tokenValue          :   'title',
                theme               :   'bootstrap',
                searchDelay         :   0,
                tokenLimit          :   5,
                preventDuplicates   :   true,
                animateDropdown     :   true,
                allowFreeTagging    :   true,
                hintText            :   '请输入标签名',
                noResultsText       :   '此标签不存在, 按回车创建',
                searchingText       :   "查找中...",
                prePopulate         :   tagsPre,
                onAdd: function (item){ //新增系统没有的标签时提交到数据库
                    $.post('<?php echo U(C("MODULE_MARK")."/Tag/add");?>', {'title': item.title});
                }
            });
        });
    </script><?php break;?>
                                                                            
                                                                            <?php case "board": ?><input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value='<?php echo ($tab_form["value"]); ?>'>
    <div class="row board_list boards_<?php echo ($tab_k); ?>" <?php echo ($tab_form["extra_attr"]); ?>>
        <div class="container-fluid">
            <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="panel panel-default board col-xs-12 col-sm-3" data-id="<?php echo ($option_key); ?>">
                    <div class="panel-heading">
                        <strong><?php echo ($option["title"]); ?></strong>
                    </div>
                    <div class="list-group dragsort_<?php echo ($tab_k); ?>" data-group="<?php echo ($option_key); ?>">
                        <?php if(is_array($option["field"])): foreach($option["field"] as $option_field_key=>$option_field): ?><div class="list-group-item">
                                <em data="<?php echo ($field['id']); ?>"><?php echo ($option_field); ?></em>
                                <input type="hidden" name="<?php echo ($tab_form["name"]); ?>[<?php echo ($option_key); ?>][]" value="<?php echo ($option_field_key); ?>"/>
                            </div><?php endforeach; endif; ?>
                    </div>
                </div><?php endforeach; endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        //拖曳插件初始化
        $(function(){
            $(".dragsort_<?php echo ($tab_k); ?>").dragsort({
                 dragSelector:'div',
                 placeHolderTemplate: '<div class="clearfix draging-place">&nbsp;</div>',
                 dragBetween:true, //允许拖动到任意地方
                 dragEnd:function(){
                     var self = $(this);
                     self.find('input').attr('name', '<?php echo ($tab_form["name"]); ?>[' + self.closest('.dragsort_<?php echo ($tab_k); ?>').data('group') + '][]');
                 }
             });
        });
    </script><?php break; endswitch;?>

                                                                    </div>
                                                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </div>
                                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </div>
                                        </div><?php break; endswitch;?>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if(empty($form_items)): ?><div class="builder-data-empty text-center">
                            <div class="empty-info">
                                <i class="fa fa-database"></i> 暂时没有数据<br>
                                <span class="small">本系统由 <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank"><?php echo C('PRODUCT_NAME');?></a> v<?php echo C('CURRENT_VERSION');?> 强力驱动</span>
                            </div>
                        </div><?php endif; ?>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block submit ajax-post visible-xs visible-sm" type="submit" target-form="builder-form">确定</button>
                        <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="submit" target-form="builder-form">确定</button>
                        <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
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
	<script src="/Public/Libs/jquery_huploadify/jquery.Huploadify.js"></script>
	<script src="/Public/Libs/jquery_dragsort/jquery.dragsort.min.js"></script>	
	<script src="/Public/Libs/font_awesome_picker/font-awesome.picker.js"></script>
	<script src="/Public/Libs/moment/min/moment-with-locales.min.js"></script>
	<script src="/Public/Libs/bootstrap_daterangepicker/daterangepicker.js"></script>	

	</body>

</html>