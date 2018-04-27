<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title><?php echo ($meta_title); ?> | </title>
		<link href="/Public/Wap/css/weui.min.css" rel="stylesheet" />
		<link href="/Public/Wap/css/swiper.min.css" rel="stylesheet" />
		<link href="/Public/Wap/css/common.css" rel="stylesheet" />
		<style type="text/css">
			.weui_media_desc {
				-webkit-line-clamp: 6 !important;
			}
			.pagination {
			  display: inline-block;
			  padding-left: 0;
			  margin: 20px 5px;
			  border-radius: 4px;
			}
			.pagination > li {
			  display: inline;
			}
			.pagination > li > a,
			.pagination > li > span {
			  position: relative;
			  float: left;
			  padding: 6px 24px;
			  margin-left: -1px;
			  line-height: 1.42857143;
			  color: #337ab7;
			  text-decoration: none;
			  background-color: #fff;
			  border: 1px solid #ddd;
			}
			.pagination > li:first-child > a,
			.pagination > li:first-child > span {
			  margin-left: 0;
			  border-top-left-radius: 4px;
			  border-bottom-left-radius: 4px;
			}
			.pagination > li:last-child > a,
			.pagination > li:last-child > span {
			  border-top-right-radius: 4px;
			  border-bottom-right-radius: 4px;
			}
			.pagination > li > a:hover,
			.pagination > li > span:hover,
			.pagination > li > a:focus,
			.pagination > li > span:focus {
			  z-index: 3;
			  color: #23527c;
			  background-color: #eee;
			  border-color: #ddd;
			}
			.pagination > .active > a,
			.pagination > .active > span,
			.pagination > .active > a:hover,
			.pagination > .active > span:hover,
			.pagination > .active > a:focus,
			.pagination > .active > span:focus {
			  z-index: 2;
			  color: #fff;
			  cursor: default;
			  background-color: #337ab7;
			  border-color: #337ab7;
			}
			.pagination > .disabled > span,
			.pagination > .disabled > span:hover,
			.pagination > .disabled > span:focus,
			.pagination > .disabled > a,
			.pagination > .disabled > a:hover,
			.pagination > .disabled > a:focus {
			  color: #777;
			  cursor: not-allowed;
			  background-color: #fff;
			  border-color: #ddd;
			}			
		</style>
		
	</head>
	<body>
		<div class="weui_tab">
	        <div class="weui_navbar">
            	<a href="<?php echo U('pending');?>" class="weui_navbar_item <?php if($menu == 0): ?>weui_bar_item_on<?php endif; ?>">待审核</a>
            	<a href="<?php echo U('hasPass');?>" class="weui_navbar_item <?php if($menu == 1): ?>weui_bar_item_on<?php endif; ?>">已通过</a>
            	<a href="<?php echo U('noPass');?>" class="weui_navbar_item <?php if($menu == 2): ?>weui_bar_item_on<?php endif; ?>">未通过</a>
            	<a href="<?php echo U('delete');?>" class="weui_navbar_item <?php if($menu == -1): ?>weui_bar_item_on<?php endif; ?>">回收站</a>
	        </div>
	        <div class="weui_tab_bd">
	        	
	<?php if(is_array($feed_list)): $i = 0; $__LIST__ = $feed_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$feed_info): $mod = ($i % 2 );++$i;?><div class="weui_panel weui_panel_access">
		    <div class="weui_panel_hd"><?php echo ($feed_info['feed_ctime']); ?></div>
		    <div class="weui_panel_bd">
		        <a class="weui_media_box weui_media_appmsg imgsView" href="javascript:void(0);" data-pics="<?php echo ($feed_info['pics_url']); ?>">
		            <div class="weui_media_hd">
		                <img class="weui_media_appmsg_thumb" src="<?php echo ($feed_info['member']['member_avatar']); ?>" alt="">
		            </div>
		            <div class="weui_media_bd">
		            	<h4 class="weui_media_title"><?php echo ($feed_info['member']['member_name']); ?></h4>
		                <p class="weui_media_desc"><?php echo ($feed_info['feed_content']); ?></p>
		            </div>
		        </a>
		    </div>
		    <a class="weui_panel_ft confirm" href="javascript:void(0);" data-msg="是否屏蔽?" data-href="<?php echo U('Index/hide', array('feed_id'=>$feed_info['feed_id']));?>">屏蔽</a>
		    <a class="weui_panel_ft confirm" href="javascript:void(0);" data-msg="是否放入回收站?" data-href="<?php echo U('Index/doDelete', array('feed_id'=>$feed_info['feed_id']));?>">回收站</a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	
    <?php if(!empty($data_page)): ?><ul class="pagination"><?php echo ($data_page); ?></ul><?php endif; ?>	

	        </div>
	    </div>
		
		<script src="/Public/Wap/js/jquery-2.1.4.min.js"></script>
		<script src="/Public/Wap/js/fastclick.min.js"></script>
		<script src="/Public/Wap/js/weui.min.js"></script>
		<script src="/Public/Wap/js/swiper.jquery.min.js"></script>
		<script src="/Public/Wap/js/pinchzoom.min.js"></script>
		<script src="/Public/Wap/js/common.js"></script>
		
	<script>
		$(function(){
			$('body').on('click', '.confirm', function(){
				var url = $(this).data('href');
				var msg = $(this).data('msg');
				
				$.weui.confirm(msg, function(){
					location = url;
				})
			});			
		});
	</script>

	</body>
</html>