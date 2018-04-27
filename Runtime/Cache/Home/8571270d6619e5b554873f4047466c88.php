<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<title>126+个人中心</title>
	<style type="text/css">
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

		.person-head {
			padding-top: 30px;
			width: 100%;
			background: url(img/bg1.png) no-repeat;
			height: 200px;
			background-size: 100% 100%;
		}

		.head-img {
			/*margin-top: 30px;*/
			height: 80px;
			width: 100%;
			text-align: center;
		}

		.head-img img {
			width: 50px;
			height: 50px;
			border-radius: 50%;
		}

		.head-img small {
			display: block;
			padding-top: 5px;
		}

		.head-frame {
			margin-top: 30px;
			height: 50px;
			text-align: center;
		}

		.head-frame .frame-l {
			margin-left: 25%;
			float: left;
			color: #be7754;
			border: 1px solid #be7754;
			width: 60px;
			font-size: 16px;
			height: 30px;
			line-height: 30px;
			border-radius: 3px;
		}

		.head-frame .frame-r {
			margin-right: 25%;
			float: right;
			color: #be7754;
			border: 1px solid #be7754;
			width: 60px;
			font-size: 16px;
			height: 30px;
			line-height: 30px;
			border-radius: 3px;
		}

		.person-news,
		.person-news-home {
			padding-top: 11px;
			width: 100%;
			height: 60px;
			background-color: #fff;
		}

		.person-news li {
			float: left;
			width: 25%;
			font-weight: 500;
			text-align: center;
		}

		.person-news-home li {
			float: left;
			width: 33%;
			font-weight: 500;
			text-align: center;
		}

		.person-news small,
		.person-news-home small {
			display: block;
			color: #171717;
		}

		.person-con {
			width: 100%;
			background-color: #fff;
			min-height: 220px;
			padding: 10px 15px;
			margin-bottom: 50px;
			overflow: hidden;
        overflow-y: scroll;
       
        -webkit-overflow-scrolling: touch;
		}

		.person-con-img {
			position: relative;
			float: left;
			margin: 3px 1%;
			width: 31%;
			border: none;
			outline: none;
			overflow: hidden;	
	
		}

		.person-con-img img {
			width: 100%;
		}

		.person-con-img .number {
			opacity: 0.7;
			position: absolute;
			border-radius: 50%;
			width: 18px;
			height: 18px;
			font-size: 12px;
			line-height: 18px;
			bottom: 3px;
			right: 3px;
			background-color: #000;
			text-align: center;
			z-index: 3;
		}

		.person-con-img .number span {
			opacity: 0.7;
			color: #fff;
		}

		.head-frame .frame-l-home {
			margin: 0 auto;
			background: #e68d61;
			color: #fff;
			width: 60px;
			font-size: 16px;
			height: 30px;
			line-height: 30px;
			border-radius: 3px;
		}

		.followed {
			border: 1px solid #e68d61 !important;
			background: #fff !important;
			color: #e68d61 !important;
		}
		.person-con:after{
			display: block;
			content: '';
			visibility:hidden;
			 clear:both;
		}
		
	</style>
</head>

<body>
	<div class="person-container">

	</div>
	<script type="text/template" id="info">
		<div class="person-head">
				<div class="head-img">
					<img src="{{data.member_info.headimgurl}}">
					<small>{{data.member_info.member_name}}</small>
				</div>
				<div class="head-frame">
					{{if data.is_self}}
					<a href="message.html">
							<div class="frame-l">
								<span>私信</span>
							</div>
						</a>
						<a href="prize-git.html">
							<div class="frame-r">
								<span>奖券</span>
							</div>
						</a>
					{{/if}}
					{{if !data.is_self}}
					 {{if data.is_follow}}
					 <div class="frame-l-home followed" onclick="follow({{data.member_info.member_id}})">已关注</div>
					 {{else}}
					 <div class="frame-l-home" onclick="follow({{data.member_info.member_id}})">关注</div>
					 {{/if}}	
					{{/if}}
				</div>
			</div>
			{{if data.is_self}}
			<div class="person-news">
					<li onclick="javascript:window.location.href='follow.html?type=1'">{{data.follow_count}}<small>关注</small></li>
					<li onclick="javascript:window.location.href='follow.html?type=2'">{{data.fans_count}}<small>粉丝</small></li>
					<li onclick="javascript:window.location.href='likeList.html'">{{data.fav_count}}<small>喜欢</small></li>
					<li onclick="javascript:window.location.href='message_list.html?id='+{{data.member_info.member_id}}">{{data.message_count}}<small>消息</small></li>
				</div>
			{{/if}}
			{{if !data.is_self}}
			<div class="person-news-home">
					<li onclick="javascript:window.location.href='follow.html?type=1&id='+{{data.member_info.member_id}}">{{data.follow_count}}<small>关注</small></li>
					<li onclick="javascript:window.location.href='follow.html?type=2&id='+{{data.member_info.member_id}}">{{data.fans_count}}<small>粉丝</small></li>
					<li onclick="javascript:window.location.href='likeList.html?id='+{{data.member_info.member_id}}">{{data.fav_count}}<small>喜欢</small></li>
				</div>
			{{/if}}
			<div style="height: 10px;background-color: #eee;"></div>
		</script>
	<div class="person-con">


	</div>
	
	<footer class="footer">
		<li style="background-image: url(img/map.png);" onclick="javascript:window.location.href='map.html'">在线地图</li>
		<li style="background-image: url(img/share.png);" onclick="javascript:window.location.href='shareList.html'">分享榜</li>
		<li id="person" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
	</footer>
	<script type="text/template" id="list">
				{{each data as li i}}
				<a href='shareDetails.html?id={{li.feed_id}}'>
						<div class="person-con-img" style='background:url({{li.cover_url}});background-repeat: no-repeat;background-position: center;background-size:100%;background-size: cover;'>
							<!-- <img src="{{li.cover_url}}"> -->
							<div class="number"><span>{{li.pics_count}}</span></div>
						</div>
					</a> 
				{{/each}} 
			</script>
</body>
<script src="js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">

	if (GetUrlString('id')) {
		$('#person').addClass('footer_no_me')
	} else {
		$('#person').addClass('footer_on')
	}
	var listparamUL = {
		page: 1,
		member_id: ''
	}
	var h = window.screen.height;
	$(".person-con").css("min-height", (h-340)+'px');
	listparamUL.member_id = GetUrlString('id')
	getList('.person-con', 'post', wrUrl + '/feed/get_FeedList', listparamUL, setList);
	getL('.person-container', 'post', wrUrl + '/member/info', { member_id: listparamUL.member_id }, getPerson);

	function getPerson(obj, r) {
		var html = template('info', r);
		$(obj).html(html);
		if (!<?php echo ($is_flow); ?>) {
			$(obj).html('')
			tip.code('长按识别图中二维码关注公众号查看', 'wx_code')	
		}

	}
	function setList(obj, r) {
		if (r.data.length > 0) {
			r.imgurl = imgURL
			var html = template('list', r);
			$(obj).html(html);
		} else {
			if (!listparamUL.member_id) {
				var h = '<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">您还没有发表过分享呢</div></div>'
			} else {
				var h = '<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">他还没有发表过分享呢</div></div>'
			}
			$(obj).html(h)
		}
		var imgw = $(".person-con-img").css("width");
		$(".person-con-img").css("height", imgw);
		if (!<?php echo ($is_flow); ?>) {
			$(obj).html('')
			tip.code('长按识别图中二维码关注公众号查看', 'wx_code')
			
		}
	}
	function follow(i) {
		var h = $('.frame-l-home').html()
		if (h == "关注") {
			getL('.frame-l-home', 'post', wrUrl + '/Follow/add', { follow_member_id: i }, setFollow);
		} else if (h == "已关注") {
			getL('.frame-l-home', 'post', wrUrl + '/Follow/del', { follow_member_id: i }, delFollow);
		}
	}
	function setFollow(obj, r) {
		if (r.code == 200) {
			tip.alert('关注成功');
			$(obj).addClass('followed').html('已关注')
		} else {
			tip.alert(r.info);
		}
	}
	function delFollow(obj, r) {
		if (r.code == 200) {
			tip.alert('已取消关注');
			$(obj).removeClass('followed').html('关注')
		} else {
			tip.alert(r.info);
		}
	}
</script>


</html>