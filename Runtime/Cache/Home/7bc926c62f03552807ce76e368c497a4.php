<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"/> -->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<title>126+我的私信</title>
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

		.message-list {
			width: 100%;
			min-height: 400px;
		}

		.message {
			width: 100%;
			height: 80px;
			padding: 10px 3%;
			border: 1px solid #eee;
		}

		.message-l {
			float: left;
			width: 40px;
			height: 40px;
		}

		.message-l img {
			width: 100%;
			height: 100%;
		}

		.message-r {
			float: left;
			margin-left: 3%;
			width: 80%;
		}

		.message-r small {
			position: relative;
			display: block;
			font-size: 16px;
			line-height: 20px;
			color: #171717;
		}

		.message-r span {
			position: relative;
			top: 8px;
			display: block;
			float: right;
			color: #666;
			font-size: 12px;
			line-height: 1;
		}

		.message-r p {
			width: 100%;
			color: #666;
			font-size: 12px;
			padding-top: 10px;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
			display: inline-block;
		}

		.dian {
			display: block;
			background: #e85151;
			border-radius: 50%;
			width: 6px;
			height: 6px;
			top: 0px;
			right: 0px;
			position: absolute;
		}

		.say {
			text-align: center;
			color: #bbb;
			font-size: 12px;
			height: 100px;
			line-height: 100px;
		}

		.support {
			height: 50px;
			width: 100%;
			background-color: #F0F0F0;
			border-top: 1px solid #ddd;
			text-align: center;
			z-index: -1;
		}

		.support span {
			color: #aaa;
			font-size: 12px;
			display: inline-block;
			padding-top: 12.5px;
			line-height: 25px;
		}
		.no-list{
		width: 100%;
		text-align: center;
		padding-top:10%;
	}
	.list-img{
		width: 50%;
		margin:0 auto;
	}
	.no-txt{
		font-size: 12px;
		padding:20px;
		color:#bbb;
		text-align: center;
	}
		
	</style>
</head>

<body>
	<div class="message-container">
		<div class="message-list">

		</div>	
		<div class="say">
			想要私信勾搭，园区扫码进小圈子才可以哦~
		</div>
		<div class="support">
			<span>技术支持：四川易家科技</span>
		</div>
	</div>
	<script type="text/template" id="list">
		{{each data as li i}}
		<a href="share.html?id={{li.from_user_id}}&message_id={{li.id}}">
			<div class="message">
				<div class="message-l">
					<img src="{{li.from_headimgurl}}">
				</div>
				<div class="message-r">
					<small>{{li.from_member_name}}{{if li.is_read=='0'}}<i class="dian"></i>{{/if}}<span>{{li.info_time}}</span></small>
					<p>{{li.content}}</p>
				</div>
			</div>
		</a>
		{{/each}}
	</script>
</body>
<script src="js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">	
	$(function () {
		var imgw = $(".person-con-img").css("width");
		$(".person-con-img").css("height", imgw);
		var h = document.documentElement.clientHeight;
		$(".message-list").css("min-height", h - 50 - 100 + 'px');
		
	})
	getList('.message-list', 'post', wrUrl + '/Message/get_Message', {}, setList);
	function setList(obj, r) {
		if(r.data.length>0){
			r.imgurl = imgURL
			for (var i = 0; i < r.data.length; i++) {
				r.data[i].info_time= timestampToTime(r.data[i].info_time)
			}
			var html = template('list', r);
			$(obj).append(html);
		}
		if(r.data.length==0){
			$('.message-list').append('<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">什么都没有，空空如也~</div></div>');
		}
	}
</script>


</html>