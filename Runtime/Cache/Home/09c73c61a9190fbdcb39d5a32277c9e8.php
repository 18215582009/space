<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>126+商户核销</title>
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<!-- <link rel="stylesheet" type="text/css" href="css/base.css" /> -->
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

	.check {
		width: 100%;
		height: 100%;
		background: url() no-repeat center center;
	}

	.check-t {
		width: 100%;
		text-align: center;
		margin-top: 60px;
		color: red;
		font-size: 50px;
		line-height: 1;
	}

	.check-t span {
		position: relative;
		display: inline-block;
		font-size: 30px;
		top: -25px;
	}

	.commanddiv {
		width: 80%;
		margin-left: 10%;
		margin-top: 80px;
	}

	.command {
		width: 100%;
		text-align: center;
		line-height: 40px;
		font-size: 18px;
		color: #666;
	}

	.command input {
		width: 80%;
		display: inline-block;
		margin-left: 10px;
		outline: none;
		border: none;
		background-color: #e7e7e7;
		line-height: 30px;
		padding-left: 10px;
	}

	.sub {
		text-align: center;
		margin-left: 15%;
		width: 70%;
		margin-top: 50px;
		border: none;
		outline: none;
		background-color: #e68d61;
		line-height: 40px;
		color: #666;
		font-size: 18px;
		color: #fff;
		border-radius: 3px;
	}

	.w-list,
	.ed-list {
		margin-top: 10px;
		margin-left:5%;
		width: 90%;
		height: 90px;
		padding: 10px 3%;
		background-color: #fff;
		border:1px solid #eee;
		border-radius: 4px;
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

	._tiping_content_alert {
    opacity: 0;
    position: fixed;
    color: #fff;  
    border-radius: 2px;
    text-align: center;
    font-size: 13px;
    z-index: 999;
	top: 40%;
	
    padding: 10px;
    min-width: 30%;
    background: rgba(0, 0, 0, 0.8) no-repeat;
    background-position: center 15px;
	background-size: 50px 50px;
	left:35%;
}
.alert_show{
	
	animation:myfirst 2s linear 0.5s ;  
	-webkit-animation:myfirst 2s linear 0.5s ;  
}
@keyframes myfirst
{
0% {opacity: 0;}
50% {opacity: 0.8;}
100% {opacity: 0;}
}

@-moz-keyframes myfirst /* Firefox */
{
	0% {opacity: 0;}
50% {opacity: 0.8;}
100% {opacity: 0;}
}

@-webkit-keyframes myfirst /* Safari 和 Chrome */
{
	0% {opacity: 0;}
50% {opacity: 0.8;}
100% {opacity: 0;}
}

@-o-keyframes myfirst /* Opera */
{
	0% {opacity: 0;}
50% {opacity: 0.8;}
100% {opacity: 0;}
}
</style>

<body>
	<input id="my-input" type="text"  data-tit='<?php echo ($lottery); ?>' style="display:none">
	<input id="my-input_id" type="text" data-id='<?php echo ($shop_id); ?>'  style="display:none">
	<div class="check">
		<div class="check-t">
			126
			<span>+</span>
		</div>
	</div>
	<div class="content-box">
		<div class="w">
			<div class="w-list">
				<div class="w-list-t">
						<?php if(is_array($res)): foreach($res as $key=>$vo): ?><div class="w-list-t-l">
						<span style="font-size: 16px;"><?php echo ($vo["content"]); ?></span>
						<span style="font-size: 12px;color:#666;padding-top: 10px;">有限期：<?php echo ($co["start_time"]); ?>~<?php echo ($vo["end_time"]); ?></span>
						<span style="font-size: 12px;color:#aaa;padding-top: 10px;"><?php echo ($vo["explain"]); ?></span>
					</div>
					<ul class="w-list-t-r">
						<li>
							<span style="background-color: rgba(219, 169, 144, 0.36);border-radius: 3px;"><?php echo ($v0["name"]); ?></span>
						</li>
						<li style="margin-top: 18px;">
							<span><?php echo ($vo["title"]); ?></span>
						</li>
					</ul><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="commanddiv">
		<div class="command">
			口令
			<input id="key" type="" name="">
		</div>
	</div>
	<div class="sub" onclick="toWxCode()">
		核算优惠
	</div>
	<div class="_tiping_content_alert">口令不能为空！</div>
</body>
<script type="text/javascript" src="/Pulic/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/Pulic/js/login.js"></script>
<script type="text/javascript">
	console.log(<?php echo ($res); ?>)
	var params = {
		shop_key: '',
		only_key: '',
		shop_token:''
	}
	params.shop_key=document.getElementById("my-input_id").getAttribute("data-id");
	params.only_key=document.getElementById("my-input").getAttribute("data-tit");
	function toWxCode() {	
		var val=document.getElementById("key").value;
		
		if(val){
			params.shop_token=val
			ajax('http://126wenren.ejar.com.cn/LetterPool/destoryLottery',params,getData)
		}else{
			document.getElementsByClassName('_tiping_content_alert')[0].className='_tiping_content_alert alert_show'
			setTimeout(function(){
				document.getElementsByClassName('_tiping_content_alert')[0].className='_tiping_content_alert'
			},3000)
		}
		
	}
	
	function ajax(url, param, callback) {
		console.log(params)
		var xhr = new XMLHttpRequest();	
		xhr.open('post', url);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//发送请求
		xhr.send('shop_key='+params.shop_key+'&only_key='+params.only_key+'&shop_token='+params.shop_token);
		xhr.onreadystatechange = function () {
			// 这步为判断服务器是否正确响应
			if (xhr.readyState == 4 && xhr.status == 200) {
				// console.log(xhr.responseText);
				callback(xhr.responseText)
			}
		};
	}

	function getData(r){
		var res=JSON.parse(r)
		if(res.status==200){
			 window.location.href='http://126wenren.ejar.com.cn/Index/check-list.html?shop_id='+params.shop_key
		}else{
			document.getElementsByClassName('_tiping_content_alert')[0].innerHTML=res.content
			document.getElementsByClassName('_tiping_content_alert')[0].className='_tiping_content_alert alert_show'
			setTimeout(function(){
				document.getElementsByClassName('_tiping_content_alert')[0].className='_tiping_content_alert'
			},3000)
		}
			
	}
	
</script>

</html>