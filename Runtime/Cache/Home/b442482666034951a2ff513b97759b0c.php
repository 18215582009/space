<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/swiper-4.2.0.min.css" />
	<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
	<style type="text/css">
		a {
			text-decoration: none;
			color: #646464;
		}

		* {
			margin: 0px;
			padding: 0px;
			box-sizing: border-box;
			-webkit-tap-highlight-color: transparent;
		}

		body,
		html {
			width: 100%;
			height: 100%;
			margin: 0;
			font-family: "微软雅黑";
		}

		#allmap {
			height: 100%;
			width: 100%;
		}

		#r-result {
			width: 100%;
		}

		.location {
			position: fixed;
			bottom: 50px;
			z-index: 555;
			right: 5%;
			border-radius: 50%;
		}

		.location img {
			height: 60px;
			width: 60px;
		}

		.swiper-container {
			width: 100%;
			height: 100%;
		}

		.swiper-slide {
			text-align: center;
			/* font-size: 18px; */
			background: transparent;

			/* Center slide text vertically */
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			-webkit-justify-content: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			-webkit-align-items: center;
			align-items: center;
			width: 80px;
		}

		.swiper-slide {
			color: #fff;
		}

		 .index_search {
            width: 40px;
            position: absolute;
            height: 28px;
            padding-top: 4px;
            z-index: 10000000;
           margin-top:10px;
            border-right:2px solid #fff;
        }

        .index_search_y input {
            width: 80%;
            height: 30px;
            position: relative;
            top: -2px;
			padding-left: 5px;
			border:none;
            border-radius: 4px;
        }

        .index_search img{
            padding:0 5px;
            width:33px;
            position: relative;
            top: -8px;
        }

		.index_search_y img {
			padding: 0 5px;
			margin-top: 4px;
			position: relative;
			width:33px;
			top:5px;
		}

		.index_search_y {
			position: absolute;
			z-index: 10000000000;
			padding-left: 15px;
			width: 100%;
			height: 100%;
			background: #BB694F;
		}

		.goods {

			padding: 0 3%;
			padding-top: 48px;
			padding-bottom: 58px;
			background-color: #f1f1f1;
		}

		.list {
			width: 100%;
			margin-top: 10px;
			background-color: white;
			box-shadow: 0px 1px 1px #ccc;
			border-radius: 3px;
		}

		.list-t {
			width: 100%;
			height: 110px;
			padding: 0 2%;
			padding-top: 20px;
		}

		.icon_i {
			height: 76px;
			width: 76px;
			float: left;
		}

		.icon_i img {
			width: 100%;
			height: 100%;
		}

		.list-t ul {
			list-style: none;
			float: left;
			margin-left: 10px;
			width: calc(100% - 95px);

		}

		.name {
			font-size: 18px;

		}

		.name-no-list {
			font-size: 18px;
			line-height: 75px;
		}

		.name small,
		.name-no-list small {
			font-size: 18px;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
			display: inline-block;
			line-height: 1;
		}

		.addr_img {
			display: inline-block;
			width: 8%;
		}

		.addr_img>img {
			width: 17px;
			height: 18px;
		}

		.name span,
		.name-no-list span {
			float: right;
			font-size: 12px;
			color: #aaa;
			margin-left: 5px;
		}

		.time {
			font-size: 12px;
			padding-top: 5px;
			color: #646464;
		}

		.item {
			font-size: 12px;
			padding-top: 5px;
			color: #da251c;
		}

		.item span {
			background-color: #fceeed;
			margin-right: 8px;
			text-align: center;
			border-radius: 3px;
			padding: 0 3px;
			display: inline-block;
			margin-bottom: 5px;
		}

		.list-b {
			padding: 8px 0 8px 8px;
			font-size: 12px;
			color: #666;
			background: #f9f9f9;
		}

		.list-b>img {
			height: 15px;
			width: 14px;
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

		.phone {
			position: absolute;
			height: 16px;
			width: 90%;
			z-index: 2;
			margin-top: 5px;
		}

		.phone img {
			display: block;
			float: right;
			height: 16px;
			margin-right: 8px;
		}

		.location {
			position: fixed;
			bottom: 50px;
			z-index: 555;
			right: 5%;
			border-radius: 50%;
		}

		.location img {
			height: 60px;
			width: 60px;
		}

		.l {
			width: 25%;
			float: left;
		}

		.l span {
			font-size: 14px;
			color: white;
			height: 30px;
			line-height: 30px;
			display: block;
			float: left;
			text-align: center;
		}

		.support {
			margin-bottom: 50px;
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

		.footer {
			width: 100%;
			height: 49px;
			box-shadow: 0px -1px 1px 0px rgba(0, 0, 0, 0.1);
			position: fixed;
			bottom: 0;
			left: 0;
			z-index: 5;
			background-color: #FFFFFF;
		}

		li,
		ol {
			list-style: none
		}

		.footer li {
			float: left;
			width: 33.33%;
			height: 48px;
			text-align: center;
			line-height: 73px;
			color: #999999;
			font-size: 12px;
			background-repeat: no-repeat;
			background-position: center 7px;
			background-size: 20px 20px;
		}

		.footer .footer_on {
			color: #e68d61;
			background-image: url(../img/person-h.png);
		}

		.footer .footer_no_me {
			color: #999;
			background-image: url(../img/me.png);
		}

		.no-list {
			width: 100%;
			text-align: center;
			padding-top: 10%;
		}

		.list-img {
			width: 50%;
			margin: 0 auto;
		}

		.no-txt {
			font-size: 12px;
			padding: 20px;
			color: #bbb;
			text-align: center;
		}
		.activity_list{
			width:100%;
		}
		.activity_list img{
			width:100%;
		}
	</style>

	<title>126+</title>
</head>

<body>
	<div class="lr_nb">
		<div class="index_search">
			<img src="img/nav-search.png" alt="" onclick="showSearch()">
		</div>
		<div class="index_search_y display_flex align-items_center animated" style="display:none">
			<input type="text" id="key">
			<img src="img/nav-search.png" alt="">
		</div>
		<div class="swiper-container" style="margin-left:48px;">
			<div class="swiper-wrapper">
				<div class="swiper-slide current">51文青节</div>
				<div class="swiper-slide ">餐饮娱乐</div>
				<div class="swiper-slide">体育健身</div>
				<div class="swiper-slide">设计手工</div>
				<div class="swiper-slide">酒店旅社</div>
				<div class="swiper-slide">音乐演出</div>
				<div class="swiper-slide">摄影摄像</div>
				<div class="swiper-slide">婚庆周边</div>
				<div class="swiper-slide">美术相关</div>
				<div class="swiper-slide">办公文教</div>
				<div class="swiper-slide">园区服务</div>
				<div class="swiper-slide"></div>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</div>
	<div class="goods">

	</div>
	<script type="text/template" id="shop_list">
		{{each data as list i}}
			{{if list.bs_start_time!=='0'}}
			<div class="list">
				<div class="list-t">
					<div class="icon_i">
						<a href=details.html?id={{list.id}}>
							<img src="{{imgurl}}{{list.logo}}" onerror="nofind()">
						</a>					
					</div>
					<ul style="padding-left:10px;margin:0">
						<a href=details.html?id={{list.id}} style="text-decoration: none;color: #323232;"><li class="name"><small>{{list.title}}</small>
							<span>{{list.cat_name}}</span>
						</li>
						<li class="time">营业时间： {{list.bs_start_time}}</li>
						<li class="item tag">							
								{{each list.sign as pp}}						
									<span>{{pp}}</span>
							{{/each}}	
						</li>
					</a>
					</ul>
				</div>
				<a href=map.html?id={{list.id}}&catid={{list.category_id}}>
				<div class="list-b">
						<div class="addr_img">
								<img  src="img/addr.png">
						</div>			
						<div class="addr_y">商户位置：{{list.address}}</div>	
						<a href="tel:{{list.tel}}">					
						<div class="address">
							
								<img src="img/phone_h.png" class="details_phone">
														
						</div>
					</a>
					</div>
			</a>
			</div>		
			{{else}}
			<div class="list">
				<div class="list-t">
					<div class="icon_i">
						<a href=details.html?id={{list.id}}>
							<img src="{{imgurl}}{{list.logo}}" onerror="nofind()">
						</a>					
					</div>
					<ul style="padding-left:10px;margin:0">
						<a href=details.html?id={{list.id}} style="text-decoration: none;color: #323232;"><li class="name-no-list"><small>{{list.title}}</small>
							<span>{{list.cat_name}}</span>
						</li>			
					</a>
					</ul>
				</div>
			</div>	
			{{/if}}
		{{/each}}
	</script>

	<div class="lr_nb_after"></div>
	<footer class="footer" style="z-index:10000000000">
		<li class="footer_on" style="background-image: url(img/map-h.png);" onclick="javascript:window.location.href='map.html'">在线地图</li>
		<li style="background-image: url(img/share.png);" onclick="javascript:window.location.href='shareList.html'">分享榜</li>
		<li style="background-image: url(img/me.png);" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
	</footer>
	<div class="location">
		<img src="img/p_map.png">
	</div>
</body>

</html>
	<script type="text/javascript" src="js/swiper-4.2.0.min.js"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/template.js"></script>
<script src="js/login.js"></script>
<script type="text/javascript">
	var type = GetUrlString('type');//初始化类型
	if(type==1){
		type=5
		indexSwiper()
	}
	var markernav
	switch (type) {
		case '1': markernav = 0; break;
		case '70': markernav = 1; break;
		case '71': markernav = 4; break;
		case '69': markernav = 3; break;
		case '68': markernav = 5; break;
		case '55': markernav = 6; break;
		case '56': markernav = 7; break;
		case '57': markernav = 8; break;
		case '58': markernav = 2; break;
		case '59': markernav = 9; break;
		case '60': markernav = 10; break;
	}
	//顶部导航选中与位移
	$.each($('.swiper-wrapper .swiper-slide'), function () {
		if (markernav == $(this).index()) {
			$(this).addClass('current').siblings().removeClass('current');
			indexSwiper($(this).index())
		}
	});
	
	$(".location").click(function () {
		if(type=5){type=1}
		window.location.href = "map.html?catid=" + type;
	})
	var h = document.documentElement.clientHeight;
	$(".goods").css("min-height", h - 46 + 'px');
	// 顶部导航切换
	$(".swiper-wrapper .swiper-slide").click(function () {
		if($(this).index()!==11){
			markernav = $(this).index()
		$(this).addClass('current').siblings().removeClass('current');
		if (markernav == 0) {
			type = 5
			// 文青节
		}
		else if (markernav == 1) {
			type = 70
		}
		else if (markernav == 2) {
			type = 58
		}
		else if (markernav == 3) {
			type = 69
		}
		else if (markernav == 4) {
			type = 71
		}
		else if (markernav == 5) {
			type = 68
		}
		else if (markernav == 6) {
			type = 55
		}
		else if (markernav == 7) {
			type = 56
		}
		else if (markernav == 8) {
			type = 57
		} else if (markernav == 9) {
			type = 59
		} else if (markernav == 10) {
			type = 60
		}
		getlist()
		}
	});
	getlist()
	//    处理列表数据
	function getlist() {
		if(type==5){
			var h = '<a href="https://mp.weixin.qq.com/s/lpP5wAXfGaEqhmdjjA9Qcw"><div class="list"><div class="activity_list"><img src="img/activity.png">'
				h+='</div></div></a><a href="http://mp.weixin.qq.com/s?__biz=MzIxNTg2ODcwMg==&mid=100001312&idx=1&sn=fe458ba5a7d2d4cad429f2f6b42bbe06&chksm=1790f25120e77b4755df70806fe7e725fb7231dca15c6bc4dc87d994b9b468f7ed5b55b70e59#rd">'
				h+='<div class="list"><div class="activity_list"><img src="img/original.png"></div></div></a>'
			$('.goods').html(h);
		}else{
			getL('.goods', 'post', ajaxUrl + '/get_Shoplist', { type_id: type }, setList);
		}
	}
	function setList(obj, r) {
		if (r.status == 200) {
			r.imgurl = imgURL;
			var html = template('shop_list', r);
			$(obj).html(html);

		} else {
			var h = '<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">没有搜索到关键字哦~</div></div>'
			$(obj).html(h);
		}

	}

	//获取地址栏参数
	//name:地址栏参数名
	function GetUrlString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if (r != null) return unescape(r[2]);
		return '';
	}
	// 跳转列表
	function toDetail() {
		var t;
		switch (markernav) {
			case 0: t = 1; break;
			case 1: t = 70; break;
			case 4: t = 71; break;
			case 3: t = 69; break;
			case 5: t = 68; break;
			case 6: t = 55; break;
			case 7: t = 56; break;
			case 8: t = 57; break;
			case 2: t = 58; break;
			case 9: t = 59; break;
			case 10: t = 60; break;
		}
		window.location.href = 'goodslist.html?type=' + t;
		// 
	}
	function indexSwiper(i) {
		if(!i){i=0}
		var swiper = new Swiper('.swiper-container', {
			slidesPerView: 'auto',
			spaceBetween: 30,
			initialSlide: i,//设置初始化Index
			spaceBetween: 30
		});
	}
	function getSelect(key) {
		getL('.goods', 'post', ajaxUrl + '/get_Shoplist', { type_id: 1, shop_name: key }, setList);
	}
	function showSearch() {
		$('.index_search_y').css({ 'display': 'block' }).addClass('fadeInLeft')
		$('.index_search').fadeOut()
	}
	$('.index_search_y img').click(function () {
		var k = $('#key').val()
		if (k) {
			$('.swiper-wrapper .swiper-slide').removeClass('current');
			getSelect(k)
		}
		$('.index_search').show()
		$('.index_search_y').removeClass('fadeInLeft').addClass('bounceOutLeft')
	})
	function nofind() {
		var img = event.srcElement;
		img.src = "img/img_error.png";
		img.onerror = null;
	}
</script>
<style>
	/*滚动水平导航栏 start*/

	.lr_nb {
		background: url('img/bg.png') no-repeat center center;
		height: 46px;
		line-height: 46px;
		width: 100%;
		position: fixed;
		box-sizing: border-box;
		z-index: 10000;
		max-width: 1080px;
		opacity: 1;
		top: 0;
	}

	.lr_nb .slider_wrap.line {
		overflow: hidden;
		overflow-x: scroll;
		width: 100%;
		-webkit-overflow-scrolling: touch;
	}

	.lr_nb .slider_wrap.line .item_cell {
		display: inline-block;
		margin: 0px 10px;
		overflow: hidden;
		position: relative;
	}

	.lr_nb .slider_wrap.box {
		overflow: hidden;
		width: 100%
	}

	.lr_nb .slider_wrap::-webkit-scrollbar {
		display: none
	}

	.anchorBL {
		z-index: 10000 !important;
	}

	/* 改动 */

	.lr_nb .wx_items {
		white-space: nowrap;
		width: 100%;
		position: relative;
		left: 0;
		transition: .3s all;
	}

	/* 改动 */

	.lr_nb .wx_items span {
		color: #fff;
		font-size: 15px;
		white-space: nowrap;
		display: block;
		-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
		text-align: center;
		cursor: pointer
	}

	.current,
	.current a:visited,
	.current a:link,
	.current a:hover,
	.current a:focus {
		color: #fff;
		font-size: 17px;
		height: 46px;
		border-bottom: 2px solid #fff;
		font-weight: bold;
	}

	.position_wc {
		position: absolute;
		z-index: 1000000000;
		font-size: 14px;
		right: 103px;
		bottom: 75px;
		color: #000;
		opacity: 0;
	}

	.position_arc {
		display: inline-block;
		height: 6px;
		width: 6px;
		border: 3px solid #000;
		border-radius: 50%;
		background-color: #fff;
	}

	.txt_wc {
		margin: -8px 0 0 10px;
		font-weight: bold;
		font-size: 15px;
	}

	/*滚动水平导航栏 end*/
</style>