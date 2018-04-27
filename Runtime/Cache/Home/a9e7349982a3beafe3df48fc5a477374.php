<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>126+商户列表</title>
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
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

	a {
		text-decoration: none;
		color: #646464;
	}
	.no-list{
		padding:25px;
		text-align: center;
		color:#aaa;
	}
</style>

<body>
	<div class="follow-container">

	</div>
	
	<footer class="footer">
		<li style="background-image: url(img/map.png);" onclick="javascript:window.location.href='map.html'">在线地图</li>
		<li  style="background-image: url(img/share.png);" onclick="javascript:window.location.href='shareList.html'">分享榜</li>
		<li  id="person" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
	</footer>
	<script type="text/template" id="list">
		{{each data as li i}}
		<div class="follow_list" onclick="toHome({{li.follow_member_id}})"><img src="{{li.headimgurl}}" alt="" onerror="nofind()"> <span>{{li.member_name}}</span></div>  
		{{/each}} 
	</script>
</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">
if(GetUrlString('id')){
		$('#person').addClass('footer_no_me')
	}else{
		$('#person').addClass('footer_on')
	}
	var listparamUL = {
		member_id:''
	};
	var type = GetUrlString('type')
	listparamUL.member_id = GetUrlString('id')
	function info() {
		if (type == 1) {
			getList('.follow-container', 'post', wrUrl + '/Member/follow', listparamUL, setList);
		} else if (type == 2) {
			getList('.follow-container', 'post', wrUrl + '/member/fans', listparamUL, setList);
		}
	}
	info()
	// 列表
	// 	滑动请求更多
	function setList(obj, r) {
		if (r.data.length > 0) {
			r.imgurl = imgURL
			var html = template('list', r);
			$(obj).append(html);
		} else if(r.data.length==0){
			if(type==1){
				if(!listparamUL.member_id){
					var h='<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">你还没有关注任何人，快去逛逛吧~</div></div>'
				}else{
					var h='<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">他还没有关注任何人~</div></div>'
				}	
			}else{
				if(!listparamUL.member_id){
					var h='<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">咦，你还没有粉丝呢~</div></div>'
				}else{
					var h='<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">咦，他还没有粉丝呢~</div></div>'
				}		
			}
			$(obj).html(h)
		}
	}
	
	function nofind() {
		var img = event.srcElement;
		img.src = "img/img_error.png";
		img.onerror = null;
	}
	function toHome(id) {
		window.location.href='person.html?id='+id
	}
</script>

</html>