<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>126+扫码抽奖</title>
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/amazeui.min.css" />
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
	.prize{
		width: 100%;
		height: 100%;
		position: relative;
	}
	.prize-top{
		position: relative;
		width: 100%;
		background: url(img/reward_bg_1.png) no-repeat;
		background-size: 100% 100%;
	}
	.prize-top-name{
		position: absolute;
		width: 30%;
		left: 13.5%;
		top: 35%;
		height: 20px;
		text-align: center;
		border-top: 1px solid #FFFAFA;
		border-bottom: 1px solid #FFFAFA;
	}
	.prize-top-name span{
		display: block;
		font-size: 14px;
		color:#fff;
		line-height: 20px;
	}
	.prize-top-b{
		position: absolute;
		background: url(img/reward_yellow_bg.png);
		background-size: 100% 100%;
		left: 15%;
		top: 52%;
		width: 70%;
		height: 90px;
	}
	.prize-top-b-1,.prize-top-b-3{
		position: absolute;
		background: url(img/reward_bg_2.png);
		background-size: 100% 100%;
		left: 15%;
		top: 52%;
		width: 70%;
		height: 90px;
		text-align: center;
		padding-top: 25px;
		font-size: 12px;
		color: #333;
	}
	.prize-top-b-2{
		position: absolute;
		background: url(img/reward_white_bg.png);
		background-size: 100% 100%;
		left: 10%;
		top: 52%;
		width: 80%;
		height: 90px;
		font-size: 12px;
		color: #333;
	}
	.prize-top-b-2 .prize-item{
		margin-left: 5%;
		float: left;
		margin-top: 10px;
		width: 75%;
		height: 60px;
	}
	.prize-top-b-2 .prize-item li{
		padding-top: 8px;
		font-size: 12px;
		color: #666;
		line-height: 1;
	}
	.prize-top-b-2 .prize-item li:first-child{
		font-size: 14px;
		font-weight: bold;
		color: #171717;
		line-height: 1;
	}
	.prize-top-b-2 .prize-item-r{
		float: left;
		margin-top: 20px;
		width: 20%;
		height: 60px;
	}
	.prize-top-b-2 .prize-item-r small{
		font-size: 13px;
		background-color:rgba(219, 169, 144, 0.36);
		color: #be7754;
		height: 15px;
		line-height: 1;
	}
	.prize-top-b-2 .prize-item-r span{
		display: block;
		font-size: 13px;
		padding-top: 15px;
		line-height: 1;
		color: #be7754;
	}
	.prize-top-b-1 span,.prize-top-b-3 span{
		display: block;
		padding-top: 10px;
	}
	.prize-top-b small{
		display: block;
		padding-top: 20px;
		text-align: center;
		color: #e68d61;
		font-size: 16px;
		font-weight: bold;
	}
	.prize-top-b button{
		width: 30%;
		background-color: #e68d61;
		color: #fff;
		font-size: 12px;
		border: none;
		border-radius: 10px;
		height: 20px;
		line-height: 20px;
		margin-top: 10px;
		margin-left: 35%;
	}
	.prize-title{
		margin-top: 20px;
		text-align: center;
		color: #7d25cf;
		font-size: 16px;
	}
	.prize-title img{
		width: 18px;
	}
	.prize-say{
		width: 300px;
		margin:20px auto;
	}
	.prize-say li{
		font-size: 12px;
		color: #aaa;
		line-height: 1;
		margin-top: 18px;
	}
	.line{
		background-color: #eee;
		height: 8px;
		width: 100%;
	}
	.prize-num{
		margin-top: 20px;
		font-size: 14px;
		text-align: center;
		color: #333333;
	}
	.prize-num span{
		display: block;
		margin-top: 5px;
		line-height: 1;
	}
	.prize-footer{
		position: fixed;
		bottom: 0px;
		height: 50px;
		width: 100%;
		z-index: 333;
		text-align: center;
		border:none;
		font-size: 14px;
	}
	.footer-l{
		background-color: #c6c6c6;
		min-width:35%;
		color: #fff;
		line-height: 50px;
		border:none;
		/* float: left;
		max-width: 70%; */
	}
	.footer-r{
		flex: 1;
		/* min-width: 30%;
		max-width: 65%; */
		border:none;
		background-color: #e68d61;
		color: #fff;
		/* float: left; */
		line-height: 50px;
		letter-spacing: 1px;
	}
	@media (max-width: 320px){
		.prize-top-b-1,.prize-top-b-3{
			height: 70px;
			padding-top: 15px;
		}
	}
	@media (min-width: 768px) {
		.prize-top-name{
			height: 30px;
		}
		.prize-top-name span{
			font-size: 26px;
			line-height: 30px;
		}
		.prize-top-b-1,.prize-top-b-3{
			height: 140px;
			font-size: 16px;
			padding-top: 40px;
		}
		.prize-top-b{
			height: 140px;
		}
		.prize-top-b small{
			padding-top: 30px;
			font-size: 20px;
		}
		.prize-top-b button{
			width: 30%;
			font-size: 16px;
			height: 25px;
			line-height: 25px;
			margin-top: 20px;
		}
		.prize-top-b-2{
			height: 140px;
			color: #333;
		}
		.prize-top-b-2 .prize-item{
			margin-left: 20%;
			float: left;
			margin-top: 25px;
			width: 40%;
			height: 90px;
		}
		.prize-top-b-2 .prize-item li{
			padding-top: 10px;
			font-size: 14px;
		}
		.prize-top-b-2 .prize-item li:first-child{
			font-size: 16px;
		}
		.prize-top-b-2 .prize-item-r{
			margin-top: 35px;
			width: 20%;
			height: 90px;
		}
		.prize-top-b-2 .prize-item-r small{
			display: block;
			font-size: 14px;
			height: 25px;
			width: 60px;
			line-height: 25px;
			text-align: center;
		}
		.prize-top-b-2 .prize-item-r span{
			display: block;
			font-size: 14px;
			height: 30px;
			width: 60px;
			text-align: center;
			line-height: 1;
			padding-top: 16px;
		}
	}
	.prize-cue-2{
		position: absolute;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0,0,0,0.6); /*实现透明背景*/
		/* display: none; */
	}
	.prize-cue-3{
		position: absolute;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0,0,0,0.6); /*实现透明背景*/
		/* display: none; */
	}
	.prize-cue-txt-2,.prize-cue-txt-3{
		position: relative;
		z-index: 666;
		background: white;
		width: 70%;
		margin:auto;
		left: 0;
		border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
	}
	.prize-cue-bg-2,.prize-cue-bg-3{
		background: #f2e0d7;
		border-bottom-right-radius:50%;
		border-bottom-left-radius:50%;
		margin-bottom: 5px;
	}
	.prize-cue-code-2,.prize-cue-code-3{
		margin:0 auto;
		width: 45%
	}
	.prize-cue-code-2 img,.prize-cue-code-3 img{
		width: 100%;
		height: 100%;
	}
	.prize-cue-say-2,.prize-cue-say-3{
		margin:5px auto;
		font-size: 12px;
		color: #333;
		text-align: center;
	}
	.prize-cue-txt-2 small,.prize-cue-txt-3 small{
		position: relative;
		display: block;
		margin-left: auto;
		padding-top: 15px;
		padding-bottom: 15px;
		color: #be7754;
		font-size: 14px;
		line-height: 1;
		text-align: center;
	}
	.prize-cue-txt-2 small img,.prize-cue-txt-3 small img{
		width: 12px;
	}
	.prize-cue-btn-2,.prize-cue-btn-3{
		position: absolute;
		z-index: 666;
		bottom: -30px;
		left: 50%;
		margin-left: -10px;
		width: 25px;
		height: 25px;
		background: transparent;
	}
	.prize-cue-btn-2 img,.prize-cue-btn-3 img{
		width: 100%;
		height: 100%;
	}
	@media (max-width: 320px){
		.prize-cue-txt-2 small,.prize-cue-txt-3 small{
			font-size: 12px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.prize-cue-txt-2 span,.prize-cue-txt-3 span{
			margin-top:10px;
			font-size: 12px;
			padding-bottom: 10px;
		}
		.prize-cue-bg-2,.prize-cue-bg-3{
			margin-bottom:5px;
		}
	}
	@media (min-width: 768px){
		.prize-cue-txt-2 small,.prize-cue-txt-3 small{
			font-size: 16px;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.prize-cue-bg-2,.prize-cue-bg-3{
			margin-bottom:10px;
		}
	}

	.prize-cue-4{
		position: absolute;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0,0,0,0.6); /*实现透明背景*/	
	}
	.prize-cue-txt-4{
		position: relative;
		z-index: 666;
		background: white;
		width: 70%;
		margin:auto;
		left: 0;
		border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
	}
	.prize-cue-bg-4{
		background: #f2e0d7;
		border-bottom-right-radius:50%;
		border-bottom-left-radius:50%;
		margin-bottom: 15px;
	}
	.prize-cue-code-4{
		margin:0 auto;
		width: 95%;
		background: #fff;
	}
	.open-list-l{
		float: left;
		width: 60%;
		margin-left: 2%;
		text-align: left;
		border-right: 1px dotted #ddd;
	}
	.open-list-l:first-child{
		margin-top:10%;
	}
	.open-list-r{
		float: left;
		margin-top: 12%;
		margin-left: 3%;
		font-size: 14px;
	}
	.open-list-r span{
		color: #666;
	}
	.prize-win{
		text-align: center;
		font-size: 16px;
		margin-top:8%;
		color: #171717;
	}
	.prize-cue-say-4{
		margin:5px auto;
		font-size: 12px;
		color: #333;
		text-align: center;
	}
	.prize-cue-txt-4 small{
		position: relative;
		display: block;
		margin-left: auto;
		padding-top: 15px;
		padding-bottom: 15px;
		color: #be7754;
		font-size: 14px;
		line-height: 1;
		text-align: center;
	}
	.prize-cue-txt-4 small img{
		width: 12px;
	}
	.prize-cue-btn-4{
		position: absolute;
		z-index: 666;
		bottom: -30px;
		left: 50%;
		margin-left: -10px;
		width: 25px;
		height: 25px;
		background: transparent;
	}
	.prize-cue-btn-4 img{
		width: 100%;
		height: 100%;
	}
	@media (max-width: 320px){
		.prize-cue-txt-4 small{
			font-size: 12px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.prize-cue-txt-4{
			width: 80%;
		}
		.prize-cue-bg-4{
			margin-bottom:5px;
		}
		.open-list-l{
			float: left;
			width: 78%;
			margin-left: 2%;
			border-right: 1px dotted #ddd;
		}
		.open-list-l:first-child{
			margin-top:3%;
		}
		.open-list-r{
			float: left;
			margin-top: 5%;
			margin-left: 2%;
			font-size: 14px;
		}
	}
	@media (min-width: 768px){
		.prize-cue-txt-4 small{
			font-size: 16px;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.prize-cue-bg-4{
			margin-bottom:10px;
		}
	}
	.prize-step{
		position: relative;
		width: 100%;
		max-width: 720px;
		overflow-x: scroll;
		height: 150px;
		margin-top:25px;
	}
	.prize-step::-webkit-scrollbar{
		display:none;
		width: 0;
	}
	.prize-step-show{
		position: absolute;
		top: 0;
		left: 0;
		height: 150px;
		width: 720px;
	}
	.progressline{
		position: absolute;
		left: 0;
		z-index: 1;
		width: 720px;
		top: 25px;
		border:1px dotted #ccc;
	}
	.progressline-t{
		position: absolute;
		top: 25px;
		left: 0;
		z-index: 111;
		border:1px dotted #ccc;
	}
	.prize-step-num{
		position: absolute;
		top: 0;
		left: 0;
		height: 150px;
		color: #171717;
		font-size: 12px;
		text-align: center;
	}
	.step-5{
		position: absolute;
		left: 95px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}
	.step-10{
		position: absolute;
		left: 235px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}
	.step-20{
		position: absolute;
		left: 375px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}
	.step-40{
		position: absolute;
		left: 515px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}
	.step-70{
		position: absolute;
		left: 655px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}
	.prize-step-num img{
		width: 40px;
		margin-bottom: 5px;
	}
	.prize-step-num span{
		display: block;
	}
	.progressline-t-count{
		display: absolute;
		font-size: 12px;
	}
	.progressline-t-count span{
		position: absolute;
		display: block;
		line-height: 1;
	}
	@media (min-width: 768px){
		.prize-step{
			max-width: 1024px;
		}
		.prize-step-show{
			width: 1024px;
		}
		.progressline{
			width: 1024px;
		}
	}
	.support_cir {
		margin-bottom: 50px;
		height: 50px;
		color:#aaa;
		line-height: 45px;
		width: 100%;
		background-color: #F0F0F0;
		border-top: 1px solid #ddd;
		text-align: center;
		z-index: -1;
	}
	.am-modal-dialog {
		width: 88% !important;
		margin-top:-12% !important;
	}

	.bottom_name{	
		width:40%;
		overflow: hidden;
	text-overflow:ellipsis;
	white-space: nowrap;
	}
</style>

<body>
	<div class="prize">
		<div class="prize-top">
			<div class="prize-top-name">
				<span>126文化创意园</span>
			</div>
			<div class="prize-top-content">
				<div class="prize-top-b" onclick="lotteryDraw()">
					<small>翻开试试手气</small>
					<button>开始抽奖</button>
				</div>
				<div class="prize-top-b-1" style="display: none;">
					没有中奖
					<span>扫扫其他二维码试试~</span>
				</div>
				<div class="prize-top-b-3" style="display: none;">
					今天的机会没有了
					<span>明天再来吧~</span>
				</div>
				<div class="prize-top-b-2" style="display: none;">
					<ul class="prize-item">
						<li>满40减5元</li>
						<li>有限期：2017.08.09-2017.08.12</li>
						<li>周末及节假日不可用</li>
					</ul>
					<div class="prize-item-r">
						<small>满减卷</small>
						<span>吉咖啡</span>
					</div>
				</div>
			</div>
		</div>
		<div class="prize-title">
			<img src="img/reward_purple_b.png"> 抽奖说明
			<img src="img/reward_purple_b.png">
		</div>
		<ul class="prize-say">
			<li>1、满减、折扣、体验券到店消费出示即可</li>
			<li>2、实物券请至提示地点出示奖券兑换实物</li>
			<li>3、抽中的奖券在【个人中心-奖券】查看</li>
		</ul>
		<div class="line"></div>
		<div class="prize-num">
			积累【发布分享】次数
			<span>开宝箱抽大奖!</span>
		</div>

		<!-- 分享进度 -->
		<div class="prize-step">
			<div class="prize-step-show">
				<div class="progressline"></div>
				<div class="progressline-t"></div>
				<div class="progressline-t-count">
					<span>
						0次分享
					</span>
				</div>
			</div>
			<div class="prize-step-num">
				<div class="step-5">
					<img  src="img/ywk-q.png" onclick="openBox(1)">青铜宝箱
					<span>5</span>
				</div>
				<div class="step-10">
					<img src="img/ywk-b.png" onclick="openBox(2)">白银宝箱
					<span>10</span>
				</div>
				<div class="step-20">
					<img src="img/ywk-h.png" onclick="openBox(3)">黄金宝箱
					<span>20</span>
				</div>
				<div class="step-40">
					<img src="img/ywk-bo.png" onclick="openBox(4)">铂金宝箱
					<span>40</span>
				</div>
				<div class="step-70">
					<img src="img/ywk-z.png" onclick="openBox(5)">钻石宝箱
					<span>70</span>
				</div>
			</div>

		</div>
		<div class="support_cir">
			<span>技术支持：四川易家科技</span>
		</div>
		<div class="prize-footer display_flex  justify-content_flex-center align-items_center">
			<div class="footer-l display_flex  justify-content_flex-center align-items_center" onclick="toCircle()"><span>【</span><span class="bottom_name"></span><span>】小圈子</span></div>
			<div class="footer-r" onclick="toPublish()">发布分享</div>
		</div>



		<!-- 弹窗 -->
		<div class="my-box">
			
		</div>

	</div>
	<div class="am-modal am-modal-no-btn" tabindex="-1" id="your-modal">
		<div class="am-modal-dialog">

		</div>
	</div>
</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript" src="js/amazeui.min.js"></script>
<script type="text/javascript">

	//top图片高度
	var h = window.screen.height;
	$(".prize-top").css("height", h * (1 / 3));
	var nh = $(".prize-top").css("height");

	//进度条
	var q = '';
	function countnum(num) {

		if (0 < num && num <= 5) {
			q = 20 * num;
			$(".progressline-t-count span").css("left", 50);
			var html = '<img src="img/ywk-q.png" style="width:50px"><span style="font-weight:bold;">青铜宝箱</span><span>5</span>'
				$('.prize-step-num').find('div').eq(0).html(html)  // eq()遍历方法
		}
		else if (5 < num && num <= 10) {
			q = 20 * num + 40;
			$(".progressline-t-count span").css("left", 190);
			var html = '<img src="img/ywk-b.png" style="width:50px"><span style="font-weight:bold;">白银宝箱</span><span>10</span>'
				$('.prize-step-num').find('div').eq(1).html(html)  // eq()遍历方法
		}
		else if (10 < num && num <= 20) {
			q = 10 * (num - 10) + 280;
			$(".progressline-t-count span").css("left", 330);
			$(".prize-step").scrollLeft(200);
			var html = '<img src="img/ywk-h.png" style="width:50px"><span style="font-weight:bold;">黄金宝箱</span><span>20</span>'
				$('.prize-step-num').find('div').eq(2).html(html)  // eq()遍历方法
		}
		else if (20 < num && num <= 40) {
			q = 5 * (num - 20) + 420;
			$(".progressline-t-count span").css("left", 470);
			$(".prize-step").scrollLeft(300);
			var html = '<img src="img/ywk-bo.png" style="width:50px"><span style="font-weight:bold;">铂金宝箱</span><span>40</span>'
				$('.prize-step-num').find('div').eq(3).html(html)  // eq()遍历方法
		}
		else if (40 < num) {
			q = 3.3 * (num - 40) + 560;
			$(".progressline-t-count span").css("left", 610);
			$(".prize-step").scrollLeft(400);
			var html = '<img src="img/ywk-z.png" style="width:50px"><span style="font-weight:bold;">钻石宝箱</span><span>70</span>'
				$('.prize-step-num').find('div').eq(4).html(html)  // eq()遍历方法
		}
		$(".progressline-t").css("width", q);
		$(".progressline-t").css("border", "1px solid #8731d3");
	}
	// 底部跳转
	function toCircle() {
		window.location.href = 'circle.html?id=' + GetUrlString('id') + '&code=1'
	}
	function toPublish() {
		window.location.href = 'publish.html?id=' + GetUrlString('id')
	}
	//  进入获取用户分享之前抽奖信息
	getInfo('post', wrUrl + '/LetterPool', {shop_id: GetUrlString('id')}, setList);
	function setList(r) {
		if(r.status!==200){
			tip.flag(r.content,'error')
		}else{
			if (r.lottery.status == 1) {
			var html = '<div class="prize-top-b-3">已经扫过该商户咯，<span>扫一扫其他二维码试试</span></div>'
			$('.prize-top-content').html(html)
		}
		countnum(r.data.feed_count)
		$('.progressline-t-count span').html(r.data.feed_count+'次分享')
		var footHtml = '<span>【</span><span class="bottom_name">'+r.data.shopName+'</span><span>】小圈子</span>'
		$('.footer-l').html(footHtml)
		var len = $('.prize-step-num').find('img').length
		for (var i = 0; i < r.data.chest_id.length; i++) {
			if (r.data.chest_id[i] == 1) {
				var html = '<img src="img/yk-q.png" >青铜宝箱<span>5</span>'
				$('.prize-step-num').find('div').eq(r.data.chest_id[i] - 1).html(html)  // eq()遍历方法
			} if (r.data.chest_id[i] == 2) {
				var html = '<img src="img/yk-b.png">白银宝箱<span>10</span>'
				$('.prize-step-num').find('div').eq(r.data.chest_id[i] - 1).html(html);  // eq()遍历方法
			} if (r.data.chest_id[i] == 3) {
				var html = '<img src="img/yk-h.png">黄金宝箱<span>20</span>'
				$('.prize-step-num').find('div').eq(r.data.chest_id[i] - 1).html(html);  // eq()遍历方法
			} if (r.data.chest_id[i] == 4) {
				var html = '<img src="img/yk-bo.png">铂金宝箱<span>40</span>'
				$('.prize-step-num').find('div').eq(r.data.chest_id[i] - 1).html(html);  // eq()遍历方法
			} if (r.data.chest_id[i] == 5) {
				var html = '<img src="img/yk-z.png">钻石宝箱<span>70</span>'
				$('.prize-step-num').find('div').eq(r.data.chest_id[i] - 1).html(html);  // eq()遍历方法
			}
		}
		}
	}
	// 点击宝箱抽奖
	function openBox(i) {
		getL(i, 'post', wrUrl + '/LetterPool/Treasure', { type: i }, openBoxContent);
	}
	function openBoxContent(i, r) {
		if (r.status == 200) {

			if (i == 1) {
				var htm = '<img src="img/yk-q.png" >青铜宝箱<span>5</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(htm)  // eq()遍历方法
			} if (i == 2) {
				var htm = '<img src="img/yk-b.png">白银宝箱<span>10</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(htm);  // eq()遍历方法
			} if (i == 3) {
				var htm = '<img src="img/yk-h.png">黄金宝箱<span>20</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(htm);  // eq()遍历方法
			} if (i == 4) {
				var htm = '<img src="img/yk-bo.png">铂金宝箱<span>40</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(htm);  // eq()遍历方法
			} if (i == 5) {
				var htm = '<img src="img/yk-z.png">钻石宝箱<span>70</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(htm);  // eq()遍历方法
			}
			var start=timestampToTimeNom(r.start_time)
			var end=timestampToTimeNom(r.end_time)
			var con = ''
		
			con += '<div class="prize-cue-bg-4">'
			con += '<small><img src="img/reward_icon.png">&nbsp开奖了&nbsp<img src="img/reward_icon.png"></small>'
			con += '</div>'
			con += '<div class="prize-cue-code-4" style="height:120px">'
			con += '<div class="open-list">'
			con += '<div class="open-list-l">'
			con += '<li style="font-size: 16px;">'+r.data.content+'</li>'
			con += '<li style="font-size: 12px;color:#666;padding-top: 10px;">有限期：'+start+'~'+end+'</li>'
			con += '<li style="font-size: 12px;color:#aaa;padding-top: 10px;">'+r.data.explain+'</li>'
			con += '</div>'
			con += '<ul class="open-list-r">'
			con += '<li>'
			con += '<span style="background-color: rgba(219, 169, 144, 0.36);border-radius: 3px;">'+r.data.lot_type+'</span>'
			con += '</li>'
			con += '<li style="margin-top: 18px;">'
			con += '<span>'+r.data.shopname+'</span>'
			con += '</li>'
			con += '</ul>'
			con += '</div>'
			con += '</div>'
			con += '<div class="prize-win">恭喜你中奖了~</div>'
			con += '<div class="prize-cue-btn-4">'
			con += '<img src="img/reward_colse.png">'
			con += '</div>'
		

				$('.am-modal-dialog').html(con)
			var $modal = $('#your-modal');
			$modal.modal('toggle');
			//弹出框的css
			// $('.prize,.prize-cue-2,.prize-cue-3,.prize-cue-4').css("height", h);
			// var cuecode = $(".prize-cue-code-2,.prize-cue-code-3,.prize-cue-code-4").css("width");
			// $(".prize-cue-code-4").css("height", '115');
			// $(".prize-cue-txt-2,.prize-cue-txt-3,.prize-cue-txt-4").css("top", h * (200 / 667));
			// $(".prize-cue-txt-2,.prize-cue-txt-3,.prize-cue-txt-4").css("height", h * (250 / 667));

		} else if (r.status == 201) {
			if (i == 1) {
				var ht = '<img src="img/yk-q.png" >青铜宝箱<span>5</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(ht)  // eq()遍历方法
			} if (i == 2) {
				var ht = '<img src="img/yk-b.png">白银宝箱<span>10</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(ht);  // eq()遍历方法
			} if (i == 3) {
				var ht = '<img src="img/yk-h.png">黄金宝箱<span>20</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(ht);  // eq()遍历方法
			} if (i == 4) {
				var ht = '<img src="img/yk-bo.png">铂金宝箱<span>40</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(ht);  // eq()遍历方法
			} if (i == 5) {
				var ht = '<img src="img/yk-z.png">钻石宝箱<span>70</span>'
				$('.prize-step-num').find('div').eq(i - 1).html(ht);  // eq()遍历方法
			}
			var cont = ''
			cont += '<div class="prize-cue-bg-2" style="height:55px;line-height:50px;">'
			cont += '<small>'
			cont += '<img src="img/reward_icon.png">&nbsp开奖了&nbsp'
			cont += '<img src="img/reward_icon.png">'
			cont += '</small>'
			cont += '</div>'
			cont += '<div class="prize-cue-code-2">'
			cont += '<img src="img/reward_no.png">'
			cont += '</div>'
			cont += '<div class="prize-cue-say-2">没有中奖，扫扫其他二维码试试~</div>'
			cont += '<div class="prize-cue-btn-2" >'
			cont += '<img src="img/reward_colse.png">'
			cont += '</div>'
			cont += '</div>'
			cont += '</div>'

			$('.am-modal-dialog').html(cont)
			var $modal = $('#your-modal');
			$modal.modal('toggle');

		} else if (r.status == 202) {
			tip.alert('未达到分享次数!')
		}else{
			tip.flag(r.content,'error')
		}
	}
	// 点击抽奖
	function lotteryDraw() {
		getInfo('post', wrUrl + '/LetterPool/DrawforPrize', {shop_id:GetUrlString('id')}, openDraw);
	}
	function openDraw(r) {
		if (r.status == 200) {
			var start = timestampToTimeNom(r.start_time)
			var end = timestampToTimeNom(r.end_time)
			var top_content = ''
			top_content += '<div class="prize-top-b-2">'
			top_content += '<ul class="prize-item">'
			top_content += '<li>' + r.data.content + '</li>'
			top_content += '<li>有限期：' + start + '-' + end + '</li>'
			top_content += '<li>' + r.data.explain + '</li>'
			top_content += '</ul>'
			top_content += '<div class="prize-item-r">'
			top_content += '<small>' + r.data.lot_type + '</small>'
			top_content += '<span>' + r.data.shopname + '</span></div></div>'
			$('.prize-top-content').html(top_content)
			$('.prize-top-b-2').addClass('animated flipInX')
		} else if (r.status == 201) {
			// 抽奖没有中奖
			var txt = ''
			txt += '<div class="prize-top-b-1">没有中奖<span>扫扫其他二维码试试~</span></div>'
			$('.prize-top-content').html(txt)
			$('.prize-top-b-1').addClass('animated flipInX')
		}
	}

$('.am-modal-dialog').click(function(){
		var $modal = $('#your-modal');
			$modal.modal('toggle');
	})
</script>

</html>