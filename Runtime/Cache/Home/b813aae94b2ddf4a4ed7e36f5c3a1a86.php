<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>126+私信一下</title>
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
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

	.sharename {
		position: fixed;
		text-align: center;
		width: 100%;
		top: 0;
		height: 40px;
		background-color: #fff;
		z-index: 1000;
	}

	.sharename small {
		display: block;
		font-size: 14px;
		height: 40px;
		line-height: 30px;
		padding-top: 5px;
		color: #171717;
	}

	.talk {
		margin-top: 40px;
		background-color: #f1f1f1;
		padding: 20px 2%;
		overflow: auto;
		margin-bottom: 35px;
	}

	.talk-show {
		width: 100%;
	}

	.talk-con-time {
		text-align: center;
		font-size: 12px;
		color: #aaa;
		height: 20px;
		line-height: 20px;
	}

	.talk-area-r {
		position: relative;
		background-color: white;
		float: right;
		margin-top: 20px;
		margin-right: 10px;
		max-width: calc(100% - 127px);
	}

	.talk-icon {
		display: block;
		margin-top: 5px;
		float: right;
		height: 50px;
		width: 50px;
	}

	.talk-icon img {
		width: 100%;
		height: 100%;
	}

	.talk-con-horn-r {
		position: absolute;
		width: 14px;
		height: 14px;
		border-top: 7px solid transparent;
		border-left: 7px solid #fff;
		border-right: 7px solid transparent;
		border-bottom: 7px solid transparent;
		right: -14px;
		top: 7px;
	}

	.talk-con-horn-l {
		position: absolute;
		width: 14px;
		height: 14px;
		border-top: 7px solid transparent;
		border-left: 7px solid transparent;
		border-right: 7px solid #e7efe6;
		border-bottom: 7px solid transparent;
		left: -14px;
		top: 7px;
	}

	.talk-con {
		display: inline-block;
		font-size: 14px;
		line-height: 22px;
		letter-spacing: 1px;
		padding: 8px;
		border-radius: 5px;
		color: #171717;
	}

	.talk-r {
		width: 100%;
		min-height: 90px;
		margin-bottom: 20px;
	}

	.talk-l {
		width: 100%;
		min-height: 90px;
		margin-bottom: 20px;
	}

	.talk-icon-l {
		margin-top: 5px;
		float: left;
		height: 50px;
		width: 50px;
	}

	.talk-icon-l img {
		width: 100%;
		height: 100%;
	}

	.talk-area-l {
		position: relative;
		background-color: #e7efe6;
		float: left;
		margin-top: 20px;
		margin-left: 10px;
		max-width: calc(100% - 127px);
	}

	.talk-b {
		position: fixed;
		width: 100%;
		bottom: 0px;
		height: 40px;
		background-color: #fff;
		padding: 5px 3%;
		z-index: 3;
	}

	.talk-b-talk {
		height: 30px;
		line-height: 30px;
		font-size: 14px;
		border: none;
		outline: none;
		width: 85%;
		padding-left: 5%;
		background-color: #f1f1f1;
	}

	.talk-b-button {
		height: 30px;
		line-height: 30px;
		font-size: 14px;
		border: none;
		outline: none;
		width: 10%;
		padding-left: 3%;
		color: #e68d61;
	}
</style>

<body>
	<div class="sharename">
		<small>大吉日式料理</small>
	</div>
	<script type="text/template" id="list">
		{{each data as li i}}
		{{if li.is_self==1}}
		<div class="talk-r">
			<div class="talk-con-time">
				<span>
					{{li.info_time}}
				</span>
			</div>
			<div class="talk-show">
				<div class="talk-icon"><img src="{{li.headimgurl}}"></div>
				<div class="talk-area-r">
					<div class="talk-con-horn-r"></div>
					<p class="talk-con">{{li.content}}</p>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		{{else}}
		<div class="talk-l">
			<div class="talk-con-time">
				<span>
					{{li.info_time}}
				</span>
			</div>
			<div class="talk-show">
				<div class="talk-icon-l"><img src="{{li.headimgurl}}"></div>
				<div class="talk-area-l">
					<div class="talk-con-horn-l"></div>
					<p class="talk-con">{{li.content}}</p>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		{{/if}}
		{{/each}}
	</script>
	<div class="talk">
		<div class="talk-r">
			<div class="talk-con-time">
				<span>
					2017.08.09 12:09
				</span>
			</div>
			<div class="talk-show">
				<div class="talk-icon">
					<img src="img/5.png">
				</div>
				<div class="talk-area-r">
					<div class="talk-con-horn-r"></div>
					<p class="talk-con">还没吃，还没吃还没吃。还没吃还没吃还没吃还没还没吃还没吃还没吃</p>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		<div class="talk-l">
			<div class="talk-con-time">
				<span>
					2017.08.09 12:09
				</span>
			</div>
			<div class="talk-show">
				<div class="talk-icon-l">
					<img src="img/6.png">
				</div>
				<div class="talk-area-l">
					<div class="talk-con-horn-l"></div>
					<p class="talk-con">还没吃还没吃还没吃还没吃还没吃还没吃还没吃</p>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>


	</div>
	<div class="limit"></div>
	<div class="talk-b">
		<input type="text" name="" placeholder="在这里输入内容" class="talk-b-talk y_input">
		<div style="width:15%;float:right;text-align:center;" onclick="sendMessage()">
			<span class="talk-b-button">发送</span>
		</div>
	</div>

</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">

	var sh = document.documentElement.clientHeight;
	$(".talk").css("height", sh - 75 + 'px');

	//滚动到最底部	
	function update() {
		var b = $('.talk')[0].scrollHeight;
		$(".talk").scrollTop(b);
	}

	// 获取聊天内容
	var send = {
		member_id: GetUrlString('id'),
		message_id: GetUrlString('message_id'),
	}
	getList('.talk', 'post', wrUrl + '/Message/get_ConnectMessage', send, allList);
	function allList(obj, res) {
		for (var i = 0; i < res.data.length; i++) {
			res.data[i].info_time = timestampToTime(res.data[i].info_time)
		}
		var html = template('list', res);
		$(obj).html(html);
		update();
	}

	var cont = {
		member_id: GetUrlString('id'),
		content: ''
	}

	// 发送消息
	function sendMessage() {
		cont.content = $('.talk-b-talk').val()
		if (cont.content) {
			getInfo('post', wrUrl + '/Message/send_UserMessage', cont, setList);
		}

	}
	function setList(r) {
		if (r.code == 200) {
			var time = timestampToTime(r.data.info_time)
			var html = "<div class='talk-r'>"
			html += "<div class='talk-con-time'>"
			html += "<span>" + time
			html += "</span>"
			html += "</div>"
			html += "<div class='talk-show'>"
			html += "<div class='talk-icon'><img src='" + r.data.headimgurl + "'></div>"
			html += "<div class='talk-area-r'>"
			html += "<div class='talk-con-horn-r'></div>"
			html += "<p class='talk-con'>" + cont.content + "</p>"
			html += "</div>"
			html += "</div>"
			html += "<div style='clear: both;'></div>"
			html += "</div>"
			$('.talk').append(html)
			var b = $('.talk')[0].scrollHeight;
			$(".talk").scrollTop(b);
			$('.talk-b-talk').val('')

		}
	}
	$(function() {
       $('input').on('click', function () {
        var target = this;
         // 使用定时器是为了让输入框上滑时更加自然
         setTimeout(function(){
		//   target.scrollIntoView(true);
		window.scrollTo(0,document.body.offsetHeight);
        },100);
       });
    })
</script>

</html>