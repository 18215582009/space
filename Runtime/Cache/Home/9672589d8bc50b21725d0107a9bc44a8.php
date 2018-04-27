<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/swiper-4.2.0.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="css/amazeui.min.css" /> -->
	<!-- <link rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/2.0.0/css/frozen.css"> -->
	<title>126+小圈子</title>
	<style type="text/css">
		.discuss {
			background-image: url(img/discuss.png);
		}

		.encourage img {
			width: 14px;
			height: 14px;
			margin-top: 11px;
			margin-left: 18px;
			position: relative;
		}
		a {
		text-decoration: none;
		color: #646464;
	}
		* {
			margin: 0px;
			padding: 0px;
			box-sizing: border-box;
			-webkit-tap-highlight-color: transparent;
		}

		body {
			font-family: 微软雅黑;
		}

		li {
			list-style: none;
		}

		.content {
			width: 100%;
			background-color: #f1f1f1;
			margin-bottom: 40px;
		}

		.details {
			width: 100%;
			min-height: 150px;
			background-color: white;
		}

		.details-t {
			width: 100%;
			min-height: 120px;
			padding-top: 20px;
		}

		ul {
			min-height:100%;
			list-style: none;
			float: left;
			padding-left: 10px;
			width: 100%;
		}

		.name {
			font-size: 16px;
			color: #323232;
			font-weight: bold;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}

		.name span {
			font-size: 12px;
			color: #aaa;
			font-weight: normal;
			padding-left: 2%;
		}

		.time {
			font-size: 12px;
			padding-top: 10px;
			color: #646464;
		}

		.item {
			font-size: 12px;
			padding-top: 15px;
			color: #da251c;
			
		}

		.item span {
			background-color: #fde4e4;
			margin-right: 8px;
			text-align: center;
			border-radius: 3px;
		}

		.details-b {
			padding-top: 10px;
			font-size: 12px;
			color: #000;
			float: left;
		}

		.details-b img {
			height: 13px;
			width: 15px;
			padding-right: 5px;
		}

		.more {
			float: right;
			height: 16px;
			color: #be7754;
			font-size: 12px;
			line-height: 12px;
			margin-right: 10px;
			font-weight: normal;
		}

		.circle-title {
			margin-top: 10px;
			height: 30px;
			background-color: #eee;
			color: #be7754;
			font-size: 14px;
			text-align: center;
		}
		.followed {
			position: absolute;
			bottom: 3px;
			right: 0;
			min-width: 35px;
			height: 20px;
			border-radius: 2px;
			text-align: center;
			font-size: 12px;
			text-align: center;
			line-height: 20px;
			background: #fff !important;
			color:#e68d61  !important;
		}
		.list {
		width: 100%;
		margin-top: 10px;
		background-color: white;
		box-shadow: 0px 1px 1px #ccc;
		border-radius: 3px;
	}

	.list-t {
		width: 100%;
		height: 110px;
		padding: 0 2%;
		padding-top: 20px;
	}

	.icon {
		height: 76px;
		width: 76px;
		float: left;
	}

	.icon img {
		width: 100%;
		height: 100%;
	}

	.list-t ul {
		list-style: none;
		float: left;
		margin-left: 10px;
		width: calc(100% - 95px);
	}

	.name {
		font-size: 18px;
		
	}
	.name-no-list {
		font-size: 18px;
		line-height:75px;
	}

	.name small,.name-no-list small {
		font-size: 18px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		display: inline-block;
		line-height: 1;
	}

	.addr_img {
		display: inline-block;
		width: 8%;
	}

	.addr_img>img {
		width: 17px;
		height: 18px;
	}

	.name span,.name-no-list span {
		float: right;
		font-size: 12px;
		color: #aaa;
		margin-left: 5px;
	}

	.time {
		font-size: 12px;
		padding-top: 5px;
		color: #646464;
	}

	.item {
		font-size: 12px;
		padding-top: 5px;
		color: #da251c;
	}

	.item span {
		background-color: #fceeed;
		margin-right: 8px;
		text-align: center;
		border-radius: 3px;
		padding: 0 3px;
		display: inline-block;
		margin-bottom: 5px;
	}

	.list-b {
		padding: 8px 0 8px 8px;
		font-size: 12px;
		color: #666;
		background: #f9f9f9;
	}

	.list-b>img {
		height: 15px;
		width: 14px;
	}

	.address {
		display: inline-block;
		height: 18px;
		width: 14%;
		text-align: center;
		border-left: 1px solid #ccc;
	}

	.address span {
		padding-right: 18px;
	}

	.address img {
		margin: 0 auto;
		height: 15px;

	}

	.phone {
		position: absolute;
		height: 16px;
		width: 90%;
		z-index: 2;
		margin-top: 5px;
	}

	.phone img {
		display: block;
		float: right;
		height: 16px;
		margin-right: 8px;
	}
	.addr_y {
		display: inline-block;
		width: 73%;
		font-weight: bold;
	}
	</style>
</head>
<body style="background-color: #eeeeee;">
	<!-- 小圈子头部改动前样式 -->
		<!-- <div class="details">
				<div class="details-t">
					<ul>
						<li class="name">{{data.title}}
							<span>{{data.cat_name}}</span>
						
								<div class="more" onclick="javascript:window.location.href='details.html?id='+{{data.id}}">
									更多详情
								</div>			
						</li>
						<li class="time">营业时间：{{data.bs_start_time}}</li>
						<li class="item">
								{{each data.sign as pp}}	
								{{if data.sign[0]!==''}}					
								<span>{{pp}}</span>
								{{/if}}
						{{/each}}	
						</li>
						<li>
							<div class="details-b">
								<img src="img/addr.png">
								<span style="background-color: #ffffff">{{data.address}}</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="circle-title">
				
			</div> -->
	<script type="text/template" id="info">
			




				<div class="list">
						<div class="list-t">
							<div class="icon">
								<a href=details.html?id={{data.id}}>
									<img src="{{imgurl}}{{data.logo}}" onerror="nofind()">
								</a>					
							</div>
							<ul>
								<a href=details.html?id={{data.id}} style="text-decoration: none;color: #323232;"><li class="name"><small>{{data.title}}</small>
									<span>{{data.cat_name}}</span>
								</li>
								<li class="time">营业时间： {{data.bs_start_time}}</li>
								<li class="item tag">							
										{{each data.sign as pp}}						
											<span>{{pp}}</span>
									{{/each}}	
								</li>
							</a>
							</ul>
						</div>
						<a href=map.html?id={{data.id}}&catid={{data.type_id}}>
						<div class="list-b">
								<div class="addr_img">
										<img  src="img/addr.png">
								</div>			
								<div class="addr_y">商户位置：{{data.address}}</div>	
								<a href="tel:{{data.tel}}">					
								<div class="address">
									
										<img src="img/phone_h.png" class="details_phone">
																
								</div>
							</a>
							</div>
					</a>
					</div>		
		</script>
	<div class="circle_top">

	</div>
	<div class="container" style="padding-bottom:50px;">

	</div>
	<script type="text/template" id="list">
		{{each data as li i}}
				<div class="shareCont_user" >
						<div class="user_header">
							<div class="header_img" onclick="javascript:window.location.href='person.html?id='+{{li.member_id}}"><img src={{li.headimgurl}}></div>
							<div class="header_cont">
								{{if type==1}}
								{{if i==0}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/one.png"> 热榜第一</span></div>
								{{/if}}
								{{if i==1}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/two.png"> 热榜第二</span></div>
								{{/if}}
								{{if i==2}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/three.png"> 热榜第三</span></div>
								{{/if}}
								{{if i==3}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/four.png"> 热榜第四</span></div>
								{{/if}}
								{{else}}
								<div  class="header_cont_name">{{li.member_name}}</div>
								{{/if}}
								<div class="header_cont_date">{{li.feed_ctime}}</div>
							</div>
						{{if !li.is_follow}}
							<div class="header_button follow_{{li.feed_id}} memeber_{{li.member_id}}" onclick="collect({{li.member_id}},{{li.feed_id}})">关注</div>
							{{/if}}
						{{if li.is_follow}}
							<div class="header_button followed follow_{{li.feed_id}} memeber_{{li.member_id}}" onclick="collect({{li.member_id}},{{li.feed_id}})">已关注</div>
							{{/if}}
							{{if li.is_self!==1}}
								<div class="header_communication" onclick="javascript:window.location.href='share.html?id='+{{li.member_id}}"></div>
								{{/if}}
						</div>

						<div class="user_cont">
							<div class="cont_text" onclick="javascript:window.location.href='shareDetails.html?id='+{{li.feed_id}}">
								{{li.content}}
							</div>
							<div class="cont_imgs">
								
								{{if li.pics_url.length==1}}
									<div class="details_long_img" onclick="toSweiper({{li.feed_id}},'0')"><img src="{{li.pics_url[0]}}" alt=""></div>
								{{else}}
									{{each li.pics_url as v a}}
									<div class="cont_img" style="background:url({{v}});background-repeat: no-repeat;background-position: center;background-size:100%;background-size: cover;" onclick="toSweiper({{li.feed_id}},{{a}})">
									
									</div>
								{{/each}}
								{{/if}}								
							</div>
							<div class="cont_icon">
								<span>【{{li.feed_title}}】</span>
								<div class="share_icon share_icon_last-child comment_num_{{li.feed_id}}" onclick="comment({{li.feed_id}})">{{li.comment_count}}</div>
								<div class="share_icon_img discuss" onclick="comment({{li.feed_id}})"></div>
								{{if li.is_fav}}
								<div class="share_icon count_{{li.feed_id}}" style="color:#e68d61">{{li.fav_count}}</div>
								{{/if}}
								{{if !li.is_fav}}
								<div class="share_icon count_{{li.feed_id}}">{{li.fav_count}}</div>
								{{/if}}
								<div class="share_icon_img encourage" id="{{li.feed_id}}" onclick="encourage({{li.feed_id}})">
										{{if li.is_fav}}
										<img src="img/encourage-h.png" data-role='1'>
										{{/if}}
										{{if !li.is_fav}}
										<img src="img/encourage.png" data-role='0'>
										{{/if}}
								</div>
							</div>
							<div class="cont_comment">
								<div class="fav_add_{{li.feed_id}}">
									{{if li.fav_list.length>0}}
									<div class="cont_comment_icon"></div>
									<div class="cont_comment_good">
										<div class="comment_good_img"></div>
										<span class="fav-content-{{li.feed_id}}">{{each li.fav_list as f a}}{{f}}、{{/each}}</span>
									</div>
									{{/if}}
							</div>
								<div class="cont_comment_details">
								<div class="comment_user comment_content_{{li.feed_id}}" onclick="comment({{li.feed_id}})">
										{{each li.comment as v n}}
											{{if n<2}}
											{{if v.comment_type==0 && !v.mid}}
													<div class="user_comment" >
											<span>{{v.member_name}}:</span>{{v.comment_content}}</div>
											{{/if}}
											{{if v.comment_type==1 && v.mid}}
											<div class="user_comment">
													<span>{{v.r_name}}</span>回复<span> &nbsp;{{v.member_name}}：</span>{{v.contents}}</div>
											{{/if}}
											{{/if}}
										{{/each}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{/each}}
	</script>
	<!-- 轮播 -->
	<div class="my_swiper">
		<div class="y_tiping">
			<div class="swiper-container">
				<div class="swiper-wrapper">
				 
				</div>
				<div class="swiper-pagination"></div>
			  </div>
		</div>
	</div>
	
	<footer class="footer">
		<li style="background-image: url(img/map.png);" onclick="javascript:window.location.href='map.html'">在线地图</li>
		<li style="background-image: url(img/share.png);" onclick="javascript:window.location.href='shareList.html'">分享榜</li>
		<li style="background-image: url(img/me.png);" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
	</footer>
	<script src="js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/template.js"></script>
	<script type="text/javascript" src="js/swiper-4.2.0.min.js"></script>
	<script type="text/javascript">
		//nav
		function click_nav(obj) {
			var index = $(obj).index();//序列号
			$(obj).addClass('nav_on').siblings().removeClass('nav_on');
			$(obj).find('div').addClass('nav_on_bottom');
			$(obj).siblings().find('div').removeClass('nav_on_bottom');
		}
		//获取图片的宽度和高度
	

		// 获取小圈子
		var listparamUL = {
			page: 1,
			shop_id: ''
		}
		var code=GetUrlString('code')
		var allData={}//存储所有数据
		var allImg=[]//存储轮播照片
		listparamUL.shop_id = GetUrlString('id')
		getL('.circle_top', 'post', ajaxUrl + '/get_Shopinfo', { id: listparamUL.shop_id }, setInfo);
		getList('.container', 'post', wrUrl + '/feed/feed_top', listparamUL, setList);

		function setInfo(obj, r) {
			r.imgurl = imgURL
			var html = template('info', r);
			$(obj).html(html);
			var bottom = '<img src="img/piao.png">【' + r.data.title + '】小圈子<img src="img/piao.png">'
			$('.circle-title').html(bottom)
		}
		function setList(obj, res) {
			if (res.data.length == 0 && !listLoadingLock) {
				listLoadingLock = true
				$('.container').append('<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">他的小圈子，还没有动态呢~</div></div>');
			} else if (res.data.length != 0) {
				res.imgurl = imgURL
				for (var i = 0; i < res.data.length; i++) {
					res.data[i].feed_ctime = timestampToTime(res.data[i].feed_ctime)
					for (var j = 0; j < res.data[i].fav_list.length; j++) {
						res.data[i].fav_list[j] = res.data[i].fav_list[j].member_name
					}
				}
				allData=res.data
				var html = template('list', res);
				$(obj).append(html);
				if(!code){	
				$('.header_communication').remove()
				}}
				var width = $('.shareCont_user .user_cont .cont_imgs .cont_img').css('width');
		$('.shareCont_user .user_cont .cont_imgs .cont_img').css('height', width);
		}		
// copy
function collect(m_id, f_id) {
			var h = $('.follow_' + f_id).html()
			if (h == "关注") {
				getL(f_id, 'post', wrUrl + '/Follow/add', { follow_member_id: m_id }, setFollow);
			} else if (h == "已关注") {
				getL(f_id, 'post', wrUrl + '/Follow/del', { follow_member_id: m_id }, delFollow);
			}
		}
		function setFollow(obj, r) {
			if(r.code==200){
				tip.alert('关注成功');
			$('.follow_' + obj).addClass('followed').html('已关注')
			}else{
				tip.alert(r.info);
			}
		
		}
		function delFollow(obj, r) {
			
			if(r.code==200){
				tip.alert('已取消关注');
			$('.follow_' + obj).removeClass('followed').html('关注')
			}else{
				tip.alert(r.info);
			}
		}
		// 点赞
		function encourage(i) {
			content.is_fav = $('#' + i).find('img').attr('data-role')
			if (content.is_fav == 1) {
				// 取消点赞		
				getL(i, 'post', wrUrl + '/Fav/del', { feed_id: i }, delGood);
			} else if (content.is_fav == 0) {
				// 点赞	
				getL(i, 'post', wrUrl + '/Fav/add', { feed_id: i }, setGood);
			}
		}
		// 取消点赞
		function delGood(obj, r) {
			if (r.code == 200) {
				var html = "<img src='img/encourage.png' data-role='0'>"
				$('#' + obj).html(html)
				var num = parseInt($('.count_' + obj).html())
				num--
				$('.count_' + obj).html(num).css({ 'color': '#000' })		
				var r=$('.fav-content-' + obj).html().replace(r.data.member_name+"、","")
				if(r!=''){
					$('.fav-content-' + obj).html(r)
				}else{												
					$('.fav_add_' + obj).html("")
				}	
				tip.alert('已取消点赞');
			} else {
				tip.flag('请求错误！', 'error');
			}
		}
		function setGood(obj, r) {
			if (r.code == 200) {
				if($('.fav-content-' + obj).html()){
					var list = r.data.member_name + '、' + $('.fav-content-' + obj).html()
				}else{
					var list = r.data.member_name+'、'
				}
				var m='<div class="cont_comment_icon"></div><div class="cont_comment_good"><div class="comment_good_img"></div><span class="fav-content-'+obj+'">'+list+'</span></div>'				
				$('.fav_add_' + obj).html(m)
				var html = '<img src="img/encourage-h.png" data-role="1">'
				$('#' + obj).html(html)
				var num = parseInt($('.count_' + obj).html())
				num++
				$('.count_' + obj).html(num).css({ 'color': '#e4393c' })
				$('#' + obj).append("<span class='num'>" + '+1' + "</span>");
				var box = $(".num");
				var left = 25;
				var top = -20;
				box.css({
					"position": "absolute",
					"left": left + "px",
					"top": top + "px",
					"z-index": 9999,
					"font-size": 20,
					"color": '#e4393c'
				})
				box.animate({
					"font-size": 10,
					"opacity": "0",
					"top": top - 30 + "px"
				}, 500, function () {
					box.remove();
				})
			} else if (r.code == 500) {
				return
			} else {
				tip.flag('请求错误！', 'error');
			}
		}
		// 回复整个评论
		var content = {
			txt: '',
			name: '',
			type: 1,
			f_id: '',
			c_id: '',
			oName: '',
			is_fav: false//是否点赞
		}
		function comment(id) {
			// content.type = 1
			content.f_id = id
			// $('.ui-dialog').addClass('show')
			window.location.href='shareDetails.html?id='+content.f_id
		}
		
	$('.my_swiper').click(function(){
		$('.my_swiper').html('')
		})
		// 点击图片展示轮播	
		// // 加载更多
		// 	$(window).scroll(function () {
		// 	var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
		// 	if ($(document).height() <= totalheight && !listLoading) {
		// 		if (!listLoadingLock) {
		// 			++listparamUL.page     //如果需要分页 listparamUL 增加page
		// 			getList('.container', 'post', wrUrl + '/feed/feed_top', listparamUL, setList);
		// 		} else if (listLoadingLock && listLoading) {
		// 			$('.container').append('<div class="buy-load"><img class="load-img" src="img/load.png"><span class="load-tips">没有更多了~</span></div>');
		// 		}
		// 	}
		// })
		function nofind() {
		var img = event.srcElement;
		img.src = "img/img_error.png";
		img.onerror = null;
	}
	</script>
</body>

</html>