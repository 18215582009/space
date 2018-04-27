<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>126+我的奖券</title>
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/amazeui.min.css" />
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
		-webkit-tap-highlight-color: transparent;
	}

	body {
		font-family: 微软雅黑;
	}

	.prize {
		width: 100%;
		height: 100%;
		position: relative;
	}

	.prize-top {
		position: relative;
		width: 100%;
		background: url(img/banner.png) no-repeat;
		background-size: 100% 100%;
	}

	.prize-top-say {
		position: absolute;
		right: 3%;
		top: 10px;
		height: 20px;
		color: #fff;
		font-size: 12px;
	}

	.prize-top-say img {
		position: relative;
		top: -2px;
		width: 14px;
	}

	.prize-nav {
		width: 100%;
		border: none;
		height: 40px;
		box-shadow: 1px 1px 2px #ccc;
		color: #666;
		background-color: #fff;
	}

	.prize-nav li {
		position: relative;
		/* display: inline-block; */
		float: left;
		width: 33.3%;
		height: 40px;
		line-height: 40px;
		text-align: center;
		font-size: 14px;
		border: none;
	}

	.li-on {
		font-size: 20px;
		color: #e68d61;
	}

	.li-on-bottom {
		position: absolute;
		bottom: 0px;
		width: 15px;
		height: 2px;
		background: #e68d61;
		left: 50%;
		margin-left: -7px;
	}

	.check-con {
		width: 100%;
		padding-top: 5px;
		padding-left: 3%;
		padding-right: 3%;
	}

	.check-list {
		margin-top: 10px;
		width: 100%;
		height: 140px;
		padding: 10px 3%;
		background-color: #fff;
		box-shadow: 0px 2px 2px #ddd;
	}

	.w-list,
	.ed-list {
		margin-top: 10px;
		width: 100%;
		height: 90px;
		padding: 10px 3%;
		background-color: #fff;
		box-shadow: 0px 2px 2px #ddd;
	}

	.check-list-t,
	.w-list-t,
	.ed-list-t {
		width: 100%;
		height: 70px;
	}

	.check-list-t-l,
	.w-list-t-l,
	.ed-list-t-l {
		padding: 5px 0;
		width: 70%;
		float: left;
		height: 70px;
		border-right: 1px dashed #ddd;
	}

	.check-list-t-l span,
	.w-list-t-l span,
	.ed-list-t-l span {
		font-size: 18px;
		line-height: 1;
		display: block;
	}

	.check-list-t-r,
	.w-list-t-r,
	.ed-list-t-r {
		margin: 5px 0;
		width: 30%;
		float: left;
		border: none;
		text-align: center;
		height: 60px;
	}

	.check-list-t-r li,
	.w-list-t-r li,
	.ed-list-t-r li {
		font-size: 14px;
		line-height: 1;
		color: #666;
		width: 100%;
		list-style: none;
	}

	.check-list-b {
		margin-top: 10px;
		height: 40px;
		width: 100%;
		border-top: 1px solid #eee;
		padding-top: 10px;
	}

	.check-list-b span {
		position: relative;
		display: block;
		font-size: 12px;
		line-height: 1;
		float: left;
		color: #666;
		top: 10px;
		margin-right: 10px;
	}

	.prize-cue {
		position: fixed;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.4);
		/*实现透明背景*/
		display: none;
	}

	.prize-cue-txt {
		position: relative;
		z-index: 666;
		background: white;
		width: 70%;
		margin: auto;
		left: 0;
		border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
	}

	.prize-cue-bg {
		background: #f2e0d7;
		border-bottom-right-radius: 50%;
		border-bottom-left-radius: 50%;
		margin-bottom: 5px;
	}

	.prize-cue-code {
		margin: 0 auto;
		width: 50%
	}

	.prize-cue-code img {
		width: 100%;
		height: 100%;
	}

	.prize-cue-txt small {
		position: relative;
		display: block;
		margin-left: auto;
		padding-top: 15px;
		color: #be7754;
		font-size: 14px;
		line-height: 1;
		text-align: center;
	}

	.prize-cue-txt span {
		display: block;
		color: #be7754;
		font-size: 14px;
		text-align: center;
		margin-top: 8px;
		line-height: 1;
		padding-bottom: 15px;
	}

	.prize-cue-txt small img {
		width: 12px;
	}

	.prize-cue-btn {
		position: absolute;
		z-index: 666;
		bottom: -30px;
		left: 50%;
		margin-left: -10px;
		width: 25px;
		height: 25px;
		background: transparent;
	}

	.prize-cue-btn img {
		width: 100%;
		height: 100%;
	}

	@media (max-width: 320px) {
		.prize-cue-txt small {
			font-size: 12px;
			padding-top: 10px;
		}
		.prize-cue-txt span {
			margin-top: 10px;
			font-size: 12px;
			padding-bottom: 10px;
		}
		.prize-cue-bg {
			margin-bottom: 5px;
		}
	}

	@media (min-width: 768px) {
		.prize-cue-txt small {
			font-size: 16px;
			padding-top: 20px;
		}
		.prize-cue-txt span {
			margin-top: 12px;
			font-size: 16px;
			padding-bottom: 20px;
		}
		.prize-cue-bg {
			margin-bottom: 10px;
		}
	}

	.prize-cue-1 {
		position: absolute;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.4);
		/*实现透明背景*/
		display: none;
	}

	.prize-cue-txt-1 {
		position: relative;
		z-index: 666;
		background: white;
		width: 70%;
		margin: auto;
		left: 0;
		border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
	}

	.prize-cue-bg-1 {
		background: #f2e0d7;
		border-bottom-right-radius: 50%;
		border-bottom-left-radius: 50%;
	}

	.prize-cue-code-1 {
		margin: 15px 3%;
		width: 94%;
	}

	.prize-cue-code-1 li {
		font-size: 12px;
		color: #333;
		padding-top: 10px;
	}

	.prize-cue-code-1 p {
		line-height: 20px;
	}

	.prize-cue-txt-1 small {
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

	.prize-cue-txt-1 small img {
		width: 12px;
	}

	.prize-cue-btn-1 {
		position: absolute;
		z-index: 666;
		bottom: -30px;
		left: 50%;
		margin-left: -10px;
		width: 25px;
		height: 25px;
		background: transparent;
	}

	.prize-cue-btn-1 img {
		width: 100%;
		height: 100%;
	}

	@media (max-width: 320px) {
		.prize-cue-txt-1 small {
			font-size: 12px;
			padding-top: 10px;
		}
		.prize-cue-txt-1 span {
			margin-top: 10px;
			font-size: 12px;
			padding-bottom: 10px;
		}
		.prize-cue-bg-1 {
			margin-bottom: 5px;
		}
		.prize-cue-code-1 {
			margin: 5px 3%;
		}
		.prize-cue-code-1 li {
			padding-top: 5px;
		}
	}

	@media (min-width: 768px) {
		.prize-cue-txt-1 small {
			font-size: 16px;
			padding-top: 20px;
		}
		.prize-cue-txt-1 span {
			margin-top: 12px;
			font-size: 16px;
			padding-bottom: 20px;
		}
		.prize-cue-code-1 li {
			padding-top: 20px;
		}
	}

	.prize-step {
		position: relative;
		width: 100%;
		max-width: 720px;
		overflow-x: scroll;
		height: 50%;
		top: 50%;
	}

	.prize-step::-webkit-scrollbar {
		display: none;
		width: 0;
	}

	.prize-step-show {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		width: 720px;
	}

	.progressline {
		position: absolute;
		left: 0;
		z-index: 1;
		width: 720px;
		top: 25px;
		border: 1px dotted #ddd;
	}

	.progressline-t {
		position: absolute;
		top: 25px;
		left: 0;
		z-index: 111;
	}

	.prize-step-num {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		color: #fff;
		font-size: 12px;
		text-align: center;
	}

	.step-5 {
		position: absolute;
		left: 95px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}

	.step-10 {
		position: absolute;
		left: 235px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}

	.step-20 {
		position: absolute;
		left: 375px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}

	.step-40 {
		position: absolute;
		left: 515px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}

	.step-70 {
		position: absolute;
		left: 655px;
		top: 5px;
		z-index: 222;
		width: 50px;
	}

	.prize-step-num img {
		width: 40px;
		margin-bottom: 5px;
	}

	.prize-step-num span {
		display: block;
	}

	.progressline-t-count {
		display: absolute;
		font-size: 12px;
		color: #fff;
		top: 23px;
	}

	@media (max-width: 320px) {
		.prize-step {
			top: 40%;
			height: 55%;
		}
	}

	@media (min-width: 768px) {
		.prize-step {
			max-width: 1024px;
		}
		.prize-step-show {
			width: 1024px;
		}
		.progressline {
			width: 1024px;
		}
	}

	.progressline-t-count {
		display: absolute;
		font-size: 12px;
	}

	.progressline-t-count span {
		position: absolute;
		display: block;
		line-height: 1;
	}







	.prize-cue-2 {
		position: fixed;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.6);
		/*实现透明背景*/
		/* display: none; */
	}

	.prize-cue-3 {
		position: absolute;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.6);
		/*实现透明背景*/
		/* display: none; */
	}

	.prize-cue-txt-2,
	.prize-cue-txt-3 {
		position: relative;
		z-index: 666;
		background: white;
		width: 70%;
		margin: auto;
		left: 0;
		border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
	}

	.prize-cue-bg-2,
	.prize-cue-bg-3 {
		background: #f2e0d7;
		border-bottom-right-radius: 50%;
		border-bottom-left-radius: 50%;
		margin-bottom: 5px;
	}

	.prize-cue-code-2,
	.prize-cue-code-3 {
		margin: 0 auto;
		width: 45%
	}

	.prize-cue-code-2 img,
	.prize-cue-code-3 img {
		width: 100%;
		height: 100%;
	}

	.prize-cue-say-2,
	.prize-cue-say-3 {
		margin: 5px auto;
		font-size: 12px;
		color: #333;
		text-align: center;
	}

	.prize-cue-txt-2 small,
	.prize-cue-txt-3 small {
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

	.prize-cue-txt-2 small img,
	.prize-cue-txt-3 small img {
		width: 12px;
	}

	.prize-cue-btn-2,
	.prize-cue-btn-3 {
		position: absolute;
		z-index: 666;
		bottom: -30px;
		left: 50%;
		margin-left: -10px;
		width: 25px;
		height: 25px;
		background: transparent;
	}

	.prize-cue-btn-2 img,
	.prize-cue-btn-3 img {
		width: 100%;
		height: 100%;
	}

	@media (max-width: 320px) {
		.prize-cue-txt-2 small,
		.prize-cue-txt-3 small {
			font-size: 12px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.prize-cue-txt-2 span,
		.prize-cue-txt-3 span {
			margin-top: 10px;
			font-size: 12px;
			padding-bottom: 10px;
		}
		.prize-cue-bg-2,
		.prize-cue-bg-3 {
			margin-bottom: 5px;
		}
	}

	@media (min-width: 768px) {
		.prize-cue-txt-2 small,
		.prize-cue-txt-3 small {
			font-size: 16px;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.prize-cue-bg-2,
		.prize-cue-bg-3 {
			margin-bottom: 10px;
		}
	}

	.prize-cue-4 {
		position: fixed;
		left: 0;
		top: 0;
		z-index: 555;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.6);
		/*实现透明背景*/
	}

	.prize-cue-txt-4 {
		position: relative;
		z-index: 666;
		background: white;
		width: 70%;
		margin: auto;
		left: 0;
		border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
	}

	.prize-cue-bg-4 {
		background: #f2e0d7;
		border-bottom-right-radius: 50%;
		border-bottom-left-radius: 50%;
		margin-bottom: 15px;
	}

	.prize-cue-code-4 {
		margin: 0 auto;
		width: 95%;
		background: #fff;
	}

	.open-list-l {
		float: left;
		width: 60%;
		margin-left: 2%;
		text-align: left;
		border-right: 1px dotted #ddd;
	}

	.open-list-l:first-child {
		margin-top: 10%;
	}

	.open-list-r {
		float: left;
		margin-top: 12%;
		margin-left: 3%;
		font-size: 14px;
	}

	.open-list-r span {
		color: #666;
	}

	.prize-win {
		text-align: center;
		font-size: 16px;
		margin-top: 8%;
		color: #171717;
	}

	.prize-cue-say-4 {
		margin: 5px auto;
		font-size: 12px;
		color: #333;
		text-align: center;
	}

	.prize-cue-txt-4 small {
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

	.prize-cue-txt-4 small img {
		width: 12px;
	}

	.prize-cue-btn-4 {
		position: absolute;
		z-index: 666;
		bottom: -30px;
		left: 50%;
		margin-left: -10px;
		width: 25px;
		height: 25px;
		background: transparent;
	}

	.prize-cue-btn-4 img {
		width: 100%;
		height: 100%;
	}

	@media (max-width: 320px) {
		.prize-cue-txt-4 small {
			font-size: 12px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.prize-cue-txt-4 {
			width: 80%;
		}
		.prize-cue-bg-4 {
			margin-bottom: 5px;
		}
		.open-list-l {
			float: left;
			width: 60%;
			margin-left: 2%;
			border-right: 1px dotted #ddd;
		}
		.open-list-l:first-child {
			margin-top: 3%;
		}
		.open-list-r {
			float: left;
			margin-top: 5%;
			margin-left: 2%;
			font-size: 14px;
		}
	}

	@media (min-width: 768px) {
		.prize-cue-txt-4 small {
			font-size: 16px;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.prize-cue-bg-4 {
			margin-bottom: 10px;
		}
	}

	.am-modal-dialog {
		width: 88% !important;
		margin-top:-12% !important;
	}
</style>

<body style="background-color: #f6f6f6">
	<div class="prize">
		<div class="prize-top">
			
				<div class="prize-top-say" onclick="toEX()">
					<img src="img/question.png"> 奖券说明
				</div>

			<!-- 分享进度 -->
			<div class="prize-step">
				<div class="prize-step-show">
					<div class="progressline"></div>
					<div class="progressline-t"></div>
					<div class="progressline-t-count">
						<span>
							4次分享
						</span>
					</div>
				</div>
				<div class="prize-step-num">
					<div class="step-5">
						<img src="img/ywk-q.png" onclick="openBox(1)">青铜宝箱
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
		</div>
		<div class="prize-nav">
			<li class="li-on" onclick="click_nav(this)">未使用
				<div class="li-on-bottom"></div>
			</li>
			<li onclick="click_nav(this)">已使用
				<div></div>
			</li>
			<li onclick="click_nav(this)">已过期
				<div></div>
			</li>
		</div>
		<script type="text/template" id="list">
			{{each data as li i}}
			{{if use== 0}}
			<div class="w" onclick="toCode('{{li.onlykey}}',{{li.shop_id}},'{{li.content}}','{{li.title}}')">
					<div class="w-list">
						<div class="w-list-t">
							<div class="w-list-t-l">
								<span style="font-size: 16px;">{{li.content}}</span>
								<span style="font-size: 12px;color:#666;padding-top: 10px;">有限期：{{li.start_time}}~{{li.end_time}}</span>
								<span style="font-size: 12px;color:#aaa;padding-top: 10px;">{{li.explain}}</span>
							</div>
							<ul class="w-list-t-r">
								<li>
									<span style="background-color: rgba(219, 169, 144, 0.36);border-radius: 3px;">{{li.name}}</span>
								</li>
								<li style="margin-top: 18px;">
									<span>{{li.title}}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				{{/if}}
	
				{{if use== 1}}
				<div class="check">
					<div class="check-list">
						<div class="check-list-t">
							<div class="check-list-t-l">
								<span style="font-size: 16px;">{{li.content}}</span>
								<span style="font-size: 12px;color:#666;padding-top: 10px;">有限期：{{li.start_time}}~{{li.end_time}}</span>
								<span style="font-size: 12px;color:#aaa;padding-top: 10px;">{{li.explain}}</span>
							</div>
							<ul class="check-list-t-r">
								<li>
									<span style="background-color: rgba(219, 169, 144, 0.36);border-radius: 3px;">{{li.name}}</span>
								</li>
								<li style="margin-top: 18px;">
									<span>{{li.title}}</span>
								</li>
							</ul>
						</div>
						<div class="check-list-b">
							<span>使用时间：{{li.usetime}}</span>
						</div>
					</div>
				</div>
				{{/if}}
	
				{{if use==2}}
				<div class="ed">
					<div class="ed-list">
						<div class="ed-list-t">
							<div class="ed-list-t-l">
								<span style="font-size: 16px;">{{li.content}}</span>
								<span style="font-size: 12px;color:#666;padding-top: 10px;">有限期：{{li.start_time}}~{{li.end_time}}</span>
								<span style="font-size: 12px;color:#aaa;padding-top: 10px;">{{li.explain}}</span>
							</div>
							<ul class="ed-list-t-r">
								<li>
									<span style="background-color: rgba(102, 102, 102, 0.29);;border-radius: 3px;">{{li.name}}</span>
								</li>
								<li style="margin-top: 18px;">
									<span>{{li.title}}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			{{/if}}
			{{/each}}
		</script>
		<div class="check-con">

			
		</div>
		<div class="prize-cue">

		</div>
		<script type="text/template" id="code">
		<div class="prize-cue-txt">
				<div class="prize-cue-bg">
					<small><img src="img/reward_icon.png">&nbsp【{{tit}}】&nbsp<img src="img/reward_icon.png"></small>
					<span>{{cont}}</span>
				</div>
				<div class="prize-cue-code"><img src="{{data.url}}"></div>
				<div class="prize-cue-btn">
					<img src="img/reward_colse.png">
				</div>
			  <div style="text-align:center;text-decoration:none;color:#aaa;font-size:14px;"><a href="details.html?id={{details_id}}">点击查看商户详情</a></div>
			</div>
	</script>
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

	//弹出框的css
	$('.prize,.prize-cue,.prize-cue-1').css("height", h);
	var cuecode = $(".prize-cue-code,.prize-cue-code-1").css("width");
	$(".prize-cue-code,.prize-cue-code-1").css("height", cuecode);
	// $(".prize-cue-txt,.prize-cue-txt-1").css("top",'20%');
	// $(".prize-cue-txt,.prize-cue-txt-1").css("height",250);

	//nav
	getL('.check-con', 'post', wrUrl + '/LetterPool/LotteryData', { use: 0 }, setList);
	function click_nav(obj) {

		var index = $(obj).index();
		console.log(index);
		$(obj).addClass('li-on').siblings().removeClass('li-on');
		$(obj).find('div').addClass('li-on-bottom');
		$(obj).siblings().find('div').removeClass('li-on-bottom');

		switch (index) {
			case 0: $(".w").show().siblings().hide(); break;
			case 1: $(".check").show().siblings().hide(); break;
			case 2: $(".ed").show().siblings().hide(); break;
		}
		getL('.check-con', 'post', wrUrl + '/LetterPool/LotteryData', { use: index }, setList);
	}
	function setList(obj, r) {
		if (r.status == 200) {
			$(obj).html('')
			for (var t = 0; t < r.data.length; t++) {
				r.data[t].end_time = timestampToTimeNom(r.data[t].end_time)
				r.data[t].start_time = timestampToTimeNom(r.data[t].start_time)
				r.data[t].usetime = timestampToTime(r.data[t].usetime)
			}
			r.use = r.use
			var html = template('list', r);
			$(obj).append(html);
		} else if (r.status == 201) {
			var h = '<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">这里空空的~</div></div>'
			$(obj).html(h)

		}
	}
	//进度条
	var q = '';
	countnum(43);
	function countnum(num) {

		if (0 < num && num <= 5) {
			q = 20 * num;
			$(".progressline-t-count span").css("left", 50);
		}
		else if (5 < num && num <= 10) {
			q = 20 * num + 40;
			$(".progressline-t-count span").css("left", 190);
		}
		else if (10 < num && num <= 20) {
			q = 10 * (num - 10) + 280;
			$(".progressline-t-count span").css("left", 330);
			$(".prize-step").scrollLeft(200);
		}
		else if (20 < num && num <= 40) {
			q = 5 * (num - 20) + 420;
			$(".progressline-t-count span").css("left", 470);
			$(".prize-step").scrollLeft(300);
		}
		else if (40 < num) {
			q = 3.3 * (num - 40) + 560;
			$(".progressline-t-count span").css("left", 610);
			$(".prize-step").scrollLeft(400);
		}
		$(".progressline-t").css("width", q);
		$(".progressline-t").css("border", "1px solid #fff");
	}
	var cook = {
		cont: '',
		tit: '',
		details_id:''
	}
	function toCode(key, id, cont, tit) {
		cook.cont = cont
		cook.tit = tit
		cook.details_id=id
		getL('.prize-cue', 'post', wrUrl + '/LetterPool/showLotteryForPicture', { only_key: key, shop_key: id }, setCode);
	}
	function setCode(obj, r) {
		$(obj).show()
		r.cont = cook.cont
		r.tit = cook.tit
		r.details_id=cook.details_id
		var html = template('code', r);
		$(obj).html(html);
		$(".prize-cue-txt,.prize-cue-txt-1").css("top", '20%');
		$(".prize-cue-txt,.prize-cue-txt-1").css("height", 250);
	}
	$('.prize-cue').click(function () {
		// $(this).hide()
		window.location.href='prize-git.html'
	})
	// 点击宝箱
	function openBox(i) {
		getL(i, 'post', wrUrl + '/LetterPool/Treasure', { type: i }, openBoxContent);
	}
	function openBoxContent(i, r) {
		console.log('阿诗丹顿多')
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
			con += '<div class="prize-cue-bg-4" style="height:55px;line-height:50px">'
			con += '<small>'
			con += '<img src="img/reward_icon.png">&nbsp开奖了&nbsp'
			con += '<img src="img/reward_icon.png">'
			con += '</small>'
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


			//弹出框的css
			$('.am-modal-dialog').html(con)
			var $modal = $('#your-modal');
			$modal.modal('toggle');
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
			tip.flag(r.content,error)
		}
	}
	// 进入页面获取宝箱信息
	getInfo('post', wrUrl + '/LetterPool/useIndex', {}, setBox);
	function setBox(r) {

		countnum(r.data.feed_count)
		$('.progressline-t-count span').html(r.data.feed_count + '次分享')

		var len = $('.prize-step-num').find('img').length
		for (var i = 0; i < r.data.chest_id.length; i++) {
			console.log(r.data.chest_id[i])
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
	$('.my-box').click(function () {
		$('.my-box').html('')
	})
	function toEX() {	
		var text = ''
		text += '<div class="prize-cue-bg-1" style="height:55px;line-height:50px;">'
		text += '<small>'
		text += '<img src="img/reward_icon.png">&nbsp奖券说明&nbsp'
		text += '<img src="img/reward_icon.png">'
		text += '</small>'
		text += '	</div>'
		text += '	<div class="prize-cue-code-1" style="text-align:left;">'
		text += '	<li>'
		text += '	<p>1、累计分享次数获得开奖资格，不同级别的宝箱奖池不同，级别越高的宝箱中大奖的概率越大！</p>'
		text += '	</li>'
		text += '	<li>'
		text += '	<p>2、满减、折扣、体验卷到店消费出示即可。</p>'
		text += '	</li>'
		text += '	<li>'
		text += '	<p>3、实物卷按地点领取。</p>'
		text += '	</li>'
		text += '	</div>'
		text += '	<div class="prize-cue-btn-1">'
		text += '	<img src="img/reward_colse.png">'
		text += '</div>'	
		$('.am-modal-dialog').html(text)
			var $modal = $('#your-modal');
			$modal.modal('toggle');
			
	}
	$('.am-modal-dialog').click(function(){
		var $modal = $('#your-modal');
			$modal.modal('toggle');
	})
</script>

</html>