<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>126+商户核销</title>
	<meta charset="utf-8"/>
	<meta name="renderer" content="webkit|ie-comp|ie-stand"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="keywords" content="">
	<meta name="description" content="">
</head>
<!-- [if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
[endif] -->
<style type="text/css">
	*{
		margin: 0px;
		padding: 0px;
		box-sizing: border-box;
		-webkit-tap-highlight-color: transparent;
	}
	body{
		font-family: 微软雅黑;
	}
	.check-con{
		background-color: #f6f6f6;
		width: 100%;
		padding-top: 5px;
		padding-left: 3%;
		padding-right:3%;
	}
	.check-list{
		margin-top: 20px;
		width: 100%;
		height: 140px;
		padding: 10px 3%;
		background-color: #fff;
		box-shadow: 0px 2px 2px #ddd;
	}
	.check-list-t{
		width: 100%;
		height: 70px;
	}
	.check-list-t-l{
		padding:5px 0;
		width: 70%;
		float: left;
		height: 70px;
		border-right: 1px dashed #ddd;
	}
	.check-list-t-l span{
		font-size: 18px;
		line-height: 1;
		display: block;
	}
	.check-list-t-r{
		margin:5px 0;
		width: 30%;
		float: left;
		border: none;
		text-align: center;
		height: 60px;
	}
	.check-list-t-r li{
		font-size: 16px;
		line-height: 1;
		color: #666;
		width: 100%;
		list-style:none;
	}
	.check-list-b{
		margin-top: 10px;
		height: 40px;
		width: 100%;
		border-top: 1px solid #eee;
		padding-top: 10px;
	}
	.check-list-b img{
		width: 29px;
		height: 29px;
	}
	.check-list-b small{
		position: relative;
		top: -8px;
		color: #666;
	}
	.check-list-b span{
		position: relative;
		display: block;
		font-size: 12px;
		line-height: 1;
		float: right;
		color: #666;
		top: 10px;
		margin-right: 10px;
	}
</style>
<body>
		<script type="text/template" id="list">
			{{each data as li i}}
			<div class="check-list">
					<div class="check-list-t">
						<div class="check-list-t-l">
							<span style="font-size: 18px;">{{li.content}}</span>
							<span style="font-size: 12px;color:#666;padding-top: 10px;">有限期：{{li.start_time}}~{{li.end_time}}</span>
							<span style="font-size: 12px;color:#aaa;padding-top: 8px;">{{li.explain}}</span>
						</div>
						<ul class="check-list-t-r">
							<li>
								<span style="background-color: #fde4e4;border-radius: 3px;">{{li.name}}</span>
							</li>
							<li style="margin-top: 18px;">
								<span>{{li.title}}</span>
							</li>
						</ul>
					</div>
					<div class="check-list-b">
						<img src="{{li.headimgurl}}">
						<small>{{li.member_name}}</small>
						<span>使用时间：{{li.usetime}}</span>
					</div>
				</div>
				{{/each}}
		</script>
	<div class="check-con">
		
	</div>
</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">
$(function() {
		var checkh=document.documentElement.clientHeight;
		$(".check-con").css("min-height",checkh);
		var id=GetUrlString('shop_id')
		getL('.check-con', 'post', wrUrl + '/LetterPool/shopCancelLottery', { shop_id: id }, setList);
		function setList(obj,r){
			if(r.data.length==0){
				var h = '<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">没有已核销奖券</div></div>'
				$(obj).html(h)
			}else{
				for (var t = 0; t < r.data.length; t++) {
				r.data[t].end_time = timestampToTimeNom(r.data[t].end_time)
				r.data[t].start_time = timestampToTimeNom(r.data[t].start_time)
				r.data[t].usetime = timestampToTime(r.data[t].usetime)
			}
				var html = template('list', r);
			$(obj).html(html);
			}
		}
	})
</script>
</html>