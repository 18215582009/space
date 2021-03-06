<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>126+评论</title>
	<meta charset="utf-8"/>
	<meta name="renderer" content="webkit|ie-comp|ie-stand"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"/>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	
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
	.comment{
		width: 100%;
		min-height: 600px;
	}
	.comment textarea{
		margin:10px 3% 50px 3%;
		border: 1px solid #ddd;
		width: 94%;
		font-size: 12px;
		min-height: 200px;
		line-height: 20px;
		padding: 8px;
		border-radius: 5px;
		outline: none;
		letter-spacing: 1px;
	}
	.comment-btn{
		background-color: #e68d61;
		width: 50%;
		height: 40px;
		color: white;
		font-size: 14px;
		letter-spacing: 2px;
		text-align: center;
		margin: 0 25%;
		border: none;
	}
</style>
<body>
	<div class="comment">
		<textarea placeholder="写评论~"></textarea>
		<button class="comment-btn">提交</button>
	</div>
	
</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>

<script type="text/javascript">
 var content={
	f_id:GetUrlString('feed_id'),
	c_id:GetUrlString('comment_id'),
	content_type:GetUrlString('content_type'),
 }
	 
 $('.comment-btn').click(function(){
	 var txt=$('textarea').val()
	 if(txt){
		if (content.content_type == 1) {
				getInfo('post', wrUrl + '/feed/comment', { feed_id: content.f_id, comment_content: txt, comment_type: 0 }, todetails);
			} else {
				getInfo('post', wrUrl + '/feed/comment', { feed_id: content.f_id, comment_id: content.c_id, comment_content: txt, comment_type: 1 }, todetails);
			}
	 }else{
		tip.alert('内容不能为空！');
	 }
 })
 function todetails(r){
	 if(r.code==200){ 
		 window.location.href='shareDetails.html?id='+content.f_id
	 }else{
		tip.flag(r.info, 'error');
	 }
 }
</script>
</html>