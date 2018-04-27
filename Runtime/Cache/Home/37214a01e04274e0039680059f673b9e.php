<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<!-- <title>126+商户详情</title> -->
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/template.js"></script>
</head>
<!-- [if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
[endif] -->

<style type="text/css">
	* {
		margin: 0px;
		padding: 0px;
		box-sizing: border-box;
	}

	body {
		font-family: 微软雅黑;
	}

	.detailsimg {
		/* background: url('img/d.png') no-repeat center center;
		background-size: cover; */
		width: 100%;
		max-height: 300px;
		overflow: hidden;
	}

	.detailsimg img {
		width: 100%
	}

	.content {
		width: 100%;
		background-color: #f1f1f1;
	}

	.details {
		width: 100%;
		min-height: 120px;
		background-color: white;
	}

	.details-t {
		width: 100%;
		height: 120px;
		padding-top: 20px;
	}

	ul {
		list-style: none;
		float: left;
		padding-left: 10px;
		width: 100%;
	}

	.name {
		font-size: 18px;
		color: #323232;
		font-weight: 500;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		padding-right: 10px;
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

	.name span {
		float: right;
		font-size: 12px;
		color: #aaa;
		margin-left: 5px;
	}

	.time {
		font-size: 12px;
		padding-top: 15px;
		color: #646464;
	}

	.item {
		font-size: 12px;
		padding-top: 15px;
		color: #da251c;
	}

	.item span {
		padding: 0 3px;
	}

	.details-b {
		font-size: 12px;
		color: #666;
		float: right;
	}

	.details-b img {
		height: 13px;
		width: 15px;
		padding-right: 5px;
	}

	.phone {
		float: right;
		height: 16px;
	}

	.phone img {
		margin-right: 10px;
		height: 16px;
	}

	.summary {
		width: 100%;
		min-height: 300px;
		margin-top: 10px;
		padding: 0 15px;
		padding-top: 20px;

		background-color: white;
	}

	.title {
		font-size: 16px;
		color: #323232;
		display: block;
		margin-bottom: 10px;
		text-align: center;
		padding: 0 10px;
	}

	.title img {
		width: 15px;
		height: 15px;
		padding-top: 5px;
	}

	/* .summary p{
		font-size: 12px;
		color: #969696;
		height: 25px;
		line-height: 25px;
		text-indent:2em
	} */

	img {
		max-width: 100%;
	}

	.bottombox {
		position: fixed;
		bottom: 0px;
		height: 40px;
		width: 100%;
		z-index: 999;
		background: #fff;
	}

	.bottombox-l {
		float: left;
		width: 30%;
		background-color: #e99971;
		text-align: center;
		height: 40px;
	}

	.bottombox-l span {
		display: block;
		color: white;
		font-size: 14px;
		height: 30px;
		line-height: 30px;
		margin-top: 5px;
	}

	.bottombox-r {
		background: #fff;
		float: right;
		width: 70%;
		text-align: center;
		font-size: 14px;
	}

	.bottombox-r span {
		display: block;
		margin-top: 5px;
		height: 30px;
		line-height: 30px;
	}

	.addr_img {
		display: inline-block;
		width: 8%;
	}

	.addr_img>img {
		width: 17px;
		height: 18px;
	}

	.item span {
		background-color: #fceeed;
		margin-right: 5px;
		text-align: center;
		border-radius: 3px;
	}

	.support {
		margin-bottom: 40px;
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

	.list-b {
		margin-top:3px;
		padding: 8px 0 8px 8px;
		font-size: 12px;
		color: #666;
		background: #f9f9f9;
	}

	.list-b>img {
		height: 15px;
		width: 14px;
	}

	a {
		-webkit-tap-highlight-color: transparent;
		-webkit-touch-callout: none;

	}

	.details_phone {
		width: auto !important;
	}

	._tiping {
		opacity: 0.8;
		position: fixed;
		color: #fff;
		line-height: 70px;
		border-radius: 10px;
		text-align: center;
		font-size: 13px;
		z-index: 999;
		top: 40%;
		padding: 0 10px;
		min-width: 120px;
		background: rgba(0, 0, 0, 0.8) no-repeat;
		background-position: center 15px;
		background-size: 50px 50px
	}

	.addr_y {
		display: inline-block;
		width: 73%;
		font-weight: bold;
	}
	.no_content{
		text-align: center;
		color:#aaa;
		}
</style>
<body>
	<div class="info">
		<script type="text/template" id="info">
			
			<div class="detailsimg" id="imgh">
				<img src={{imgurl}}{{data.shop_img}} onerror="nofind()">
			</div>
			<div class="content">
				<div class="details">
					<div class="details-t">
						<ul>
							<li class="name" value="小雅有机餐厅">{{data.title}}
							<span>{{data.cat_name}}</span>
							</li>
							<li class="time">营业时间：{{data.bs_start_time}}</li>
							<li class="item">								
									{{each data.sign as pp}}	
									{{if data.sign[0]!==''}}					
									<span>{{pp}}</span>
									{{/if}}
							{{/each}}						
							</li>
						</ul>
					</div>
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
				</div>
				<div class="summary">
						<span class="title">
							<img src="img/icon.png">
							商家简介
							<img src="img/icon.png">
						</span>
						{{if data.content!==''}}
						<p>{{#data.content}}</p>
						{{else}}
						<p><img src="img/no_content.png"/></p>
						{{/if}}
					</div>
			</div>
		</script>
	</div>
	<div class="support">
		<span>技术支持：四川易家科技</span>
	</div>
	<div class="bottombox">
		<div class="bottom-show">
			<div class="bottombox-l">
				<span>
					<img src="img/nav_w.png" style="width: 14px;"> 地图位置
				</span>
			</div>
			<div class="bottombox-r" onclick="toCircle()">
				<span class="bottom_right"></span>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">
	$(function () {
		$(window).resize(function () {
			sized();
		});
		$(function () {
			sized();
		});
		//设置图片高度
		function sized() {
			var h = document.documentElement.clientHeight;
			$('.info').css('minHeight',h)
			var pich = h / 4 + 'px';
			var imgh = document.getElementById("imgh");
			imgh.style.height = pich;
		}
		var href_data = {}
		var i = GetUrlString('id')
		getL('.info', 'post', ajaxUrl + '/get_Shopinfo', { id: i }, setInfo);
		function setInfo(obj, r) {
			
			href_data['type'] = r.data.type_id
			href_data['id'] = r.data.id
			r.imgurl = imgURL
			var html = template('info', r);
			$(obj).html(html);
			document.title = '126+'+r.data.title;
			var w=r.data.sign.join(',')
			var bot = "【" + r.data.title + "】小圈子"
			$('.bottom_right').html(bot)
			wxShare('http://126j.ejar.com.cn'+r.data.logo,w)
		
		}

		function timestampToTime(timestamp) {
			var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
			Y = date.getFullYear() + '-';
			M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
			D = date.getDate() + ' ';
			h = date.getHours() + ':';
			m = date.getMinutes();
			s = date.getSeconds();
			return h + m
		}
		// 跳转到地图
		$('.bottombox-l').click(function () {
			window.location.href = 'map.html?catid=' + href_data.type + '&id=' + href_data.id
		})
		
	});
	function nofind() {
		var img = event.srcElement;
		img.src = "img/detail_error.png";
		img.onerror = null;
	}
	function toCircle(){
		var i = GetUrlString('id')
		window.location.href='circle.html?id='+i
	}
	
</script>

</html>