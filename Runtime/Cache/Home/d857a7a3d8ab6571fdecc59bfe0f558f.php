<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>126+喜欢</title>
	<meta charset="utf-8"/>
	<meta name="renderer" content="webkit|ie-comp|ie-stand"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"/>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="css/base.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
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
	.person-con{
		width: 100%;
		background-color: #fff;
		min-height: 300px;
		padding:10px 15px;
	}
	.person-con-img{
		position: relative;
		float: left;
		margin:5px 2%;
		width: 29%;
		border: none;
		outline: none;
		overflow: hidden;
	}
	.person-con-img img{
		width: 100%;
		
	}
	.person-con-img .number{
		opacity: 0.7;
		position: absolute;
		border-radius: 50%;
		width: 18px;
		height: 18px;
		font-size: 12px;
		line-height: 18px;
		bottom:3px;
		right: 3px;
		background-color: #000;
		text-align: center;
		z-index: 3;
	}
	.person-con-img .number span{
		opacity: 0.7;
		color: #fff;
	}
	@media (min-width: 768px) {
		.person-con-img .number{
			width: 30px;
			height: 30px;
			line-height: 30px;
			font-size: 16px;
		}
	}
</style>
<body>
        <script type="text/template" id="list">
            {{each data as li i}}
            <a href='shareDetails.html?id={{li.feed_id}}'>
                    <div class="person-con-img">
                        <img src="{{li.cover_url}}">
                        <div class="number"><span>{{li.pics_count}}</span></div>
                    </div>
                </a>  
            {{/each}} 
        </script>
	<div class="person-con">
		
	</div>
	<footer class="footer">
		<li style="background-image: url(img/map.png);" onclick="javascript:window.location.href='map.html'">在线地图</li>
		<li  style="background-image: url(img/share.png);" onclick="javascript:window.location.href='shareList.html'">分享榜</li>
		<li  id="person" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
	</footer>
</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">
	$(function() {

		if(GetUrlString('id')){
		$('#person').addClass('footer_no_me')
	}else{
		$('#person').addClass('footer_on')
	}
        var listparamUL={
			member_id:''
		}
		listparamUL.member_id = GetUrlString('id')
        getList('.person-con', 'post', wrUrl + '/member/fav', listparamUL, setList);
        function setList(obj,r){
		if(r.data.length>0){
			r.imgurl = imgURL
			var html = template('list', r);
			$(obj).append(html);
			var imgw=$(".person-con-img").css("width");
        $(".person-con-img").css("height",imgw);
		}else if(r.data.length==0){
          if(!listparamUL.member_id){
			var h='<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">咦，你还没有点赞过别人呢~</div></div>'
		  }else{
			var h='<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">咦，他还没有点赞过别人呢~</div></div>'
		  }
            $(obj).html(h)
		}
	}
	})
</script>
</html>