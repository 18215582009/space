<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<title>126+小圈子</title>
	<style>
		body {
			margin: 0 auto;
			padding: 20px;
			max-width: 1200px;
			overflow-y: scroll;
			font-family: 'Open Sans', sans-serif;
			font-weight: 400;
			color: #777;
			background-color: #f7f7f7;
			-webkit-font-smoothing: antialiased;
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
		}

		.content {
			padding: 15px;
			overflow: hidden;
			background-color: #e7e7e7;
			background-color: rgba(0, 0, 0, 0.06);
		}

		h1 {
			padding-bottom: 15px;
			border-bottom: 1px solid #d8d8d8;
			font-weight: 600;
		}

		h1 span {
			font-family: monospace, serif;
		}

		h3 {
			padding-bottom: 20px;
			box-shadow: 0 1px 0 rgba(0, 0, 0, .1), 0 2px 0 rgba(255, 255, 255, .9);
		}

		p {
			margin: 0;
			padding: 10px 0;
			color: #777;
		}

		.clear {
			clear: both;
		}

		/* -----------------------------------------
  =CSS3 Loading animations
-------------------------------------------- */

		/* =Elements style
---------------------- */

		.load-wrapp {
			
			width: 100%;
			height: 100%;
			margin: 45% 10px 10px 0;
			padding: 20px 20px 20px;
			border-radius: 5px;
			text-align: center;
		}

		.load-wrapp p {
			padding: 0 0 20px;
		}

		.load-wrapp:last-child {
			margin-right: 0;
		}

		.line {
			display: inline-block;
			width: 15px;
			height: 15px;
			border-radius: 15px;
			background-color: #4b9cdb;
		}

		.load-3 .line:nth-last-child(1) {
			animation: loadingC .6s .1s linear infinite;
		}

		.load-3 .line:nth-last-child(2) {
			animation: loadingC .6s .2s linear infinite;
		}

		.load-3 .line:nth-last-child(3) {
			animation: loadingC .6s .3s linear infinite;
		}
		@keyframes loadingC {
			0% {
				transform: translate(0, 0);
			}
			50% {
				transform: translate(0, 15px);
			}
			100% {
				transform: translate(0, 0);
			}
		}
		.loading_txt{
			text-align: center;
		}	
	</style>
</head>

<body>
	<div class="load-wrapp">
		<div class="load-3">	
			<div class="line"></div>
			<div class="line"></div>
			<div class="line"></div>
		</div>
	</div>
	<div class="loading_txt">加载中...</div>
</body>
<script src="js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">
	var url = window.location.href

	getInfo('post', wrUrl + '/WeConf/get_WeiConfig', { url: url }, getConfig);
	function getConfig(r) {
		wx.config({
			debug: false,// 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。  
			appId: r.data.appId,
			timestamp: r.data.timestamp,
			nonceStr: r.data.nonceStr,
			signature: r.data.signature,
			jsApiList: ['chooseImage',
				'previewImage', 'openLocation', 'getLocation',
				'scanQRCode', 'checkJsApi', 'onMenuShareTimeline',
				'onMenuShareAppMessage', 'onMenuShareQQ',
				'onMenuShareWeibo', 'onMenuShareQZone']
		});
		wx.ready(function () {

			// config信息验证后会执行ready方法，所有接口调用都必须在config接口在ready函数中调用来
			wx.getLocation({
				type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
				success: function (res) {
					var data = {
						latitude: '',
						longitude: '',
						shop_id: GetUrlString('id')
					}
					data.latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
					data.longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
					// var speed = res.speed; // 速度，以米/每秒计
					// var accuracy = res.accuracy; // 位置精度
					// getInfo('post', wrUrl + '/WeConf/get_Distance', data, result);
					var lang = caculateLL('31.4392900000', '104.7569500000', data.latitude, data.longitude);
					if (lang < 1000) {

						window.location.href = 'prize?id=' + data.shop_id;
						//window.location.href= wrUrl + '/WeConf/get_Distance'
					} else {
						window.location.href = 'nocode.html'
					}
				}
			});
		});
		wx.error(function () {
			tip.flag('请求错误！', 'error');
			// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
		});
	}

	function caculateLL(lat1, lng1, lat2, lng2) {
		var radLat1 = lat1 * Math.PI / 180.0;
		var radLat2 = lat2 * Math.PI / 180.0;
		var a = radLat1 - radLat2;
		var b = lng1 * Math.PI / 180.0 - lng2 * Math.PI / 180.0;
		var s = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(a / 2), 2) + Math.cos(radLat1) * Math.cos(radLat2) * Math.pow(Math.sin(b / 2), 2)));
		s = s * 6378.137;
		s = Math.round(s * 10000) / 10000;
		return s
	};

</script>

</html>