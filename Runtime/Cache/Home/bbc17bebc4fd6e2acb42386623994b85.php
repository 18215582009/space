<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/amazeui.min.css" />
	<link rel="stylesheet" type="text/css" href="css/swiper-4.2.0.min.css" />
	<!-- <link rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/2.0.0/css/frozen.css"> -->
	<title>126+分享榜</title>
	<style type="text/css">
		.discuss {
			background-image: url(img/discuss.png);
		}

		.encourage img {
			width: 14px;
			height: 14px;
			margin-top: 11px;
			margin-left: 18px;
			position: relative;
		}

		.content_null {
			display: none;
		}

		.followed {
			background: #fff !important;
			color: #e68d61 !important;
		}
		.swiper_close{
			position: absolute;
			top:10px;
			right:10px;
			color:#fff;
			border:1px solid #fff;
			padding:5px;
			width:26px;
			height:26px;
			font-size: 18px;
			border-radius: 50%;
			line-height: 15px;
			z-index: 10000;
		}
		.c_container{
			padding-top:40px;
		}
	</style>
</head>

<body>
	<div class="shareHeader">
		<div class="shareHeader_nav nav_on" onclick="click_nav(this,1)">最热榜
			<div class="nav_on_bottom"></div>
		</div>
		<div class="shareHeader_nav" onclick="click_nav(this,2)">最新鲜
			<div></div>
		</div>
	</div>
	<div class="container c_container">

	</div>

		<!-- 轮播 -->
		<div class="my_swiper">
			<div class="y_tiping">
				<div class="swiper-container">
					<div class="swiper-wrapper">
					 
					</div>
					<div class="swiper-pagination"></div>
				  </div>
				  <div class="swiper_close">×</div>
			</div>
		</div>
	<!-- 弹窗end -->
	<script type="text/template" id="list">
				{{each data as li i}}
				<div class="shareCont_user" >
						<div class="user_header">
							<div class="header_img" onclick="javascript:window.location.href='person.html?id='+{{li.member_id}}"><img src={{li.headimgurl}} onerror="nofind()"></div>
							<div class="header_cont">
								{{if type==1}}
								{{if i==0}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/one.png"> 热榜第一</span></div>
								{{/if}}
								{{if i==1}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/two.png"> 热榜第二</span></div>
								{{/if}}
								{{if i==2}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/three.png"> 热榜第三</span></div>
								{{/if}}
								{{if i==3}}
								<div  class="header_cont_name">{{li.member_name}}<span><img src="img/four.png"> 热榜第四</span></div>
								{{/if}}
								{{else}}
								<div  class="header_cont_name">{{li.member_name}}</div>
								{{/if}}
								<div class="header_cont_date">{{li.feed_ctime}}</div>
							</div>
						{{if !li.is_follow}}
							<div class="header_button follow_{{li.feed_id}} memeber_{{li.member_id}}" onclick="collect({{li.member_id}},{{li.feed_id}})">关注</div>
							{{/if}}
						{{if li.is_follow}}
							<div class="header_button followed follow_{{li.feed_id}} memeber_{{li.member_id}}" onclick="collect({{li.member_id}},{{li.feed_id}})">已关注</div>
							{{/if}}
							
						</div>

						<div class="user_cont">
							<div class="cont_text" onclick="javascript:window.location.href='shareDetails.html?id='+{{li.feed_id}}">
								{{li.content}}
							</div>
							<div class="cont_imgs">
								
								{{if li.pics_url.length==1}}
									<div class="details_long_img" onclick="toSweiper({{li.feed_id}},'0')"><img src="{{li.pics_url[0]}}" alt=""></div>
								{{else}}
									{{each li.pics_url as v a}}
								<div class="cont_img" style="background:url({{v}});background-repeat: no-repeat;background-position: center;background-size:100%;background-size: cover;" onclick="toSweiper({{li.feed_id}},{{a}})">
									
								</div>
								{{/each}}
								{{/if}}								
							</div>
							<div class="cont_icon">
								<span>【{{li.feed_title}}】</span>
								<div class="share_icon share_icon_last-child comment_num_{{li.feed_id}}" onclick="comment({{li.feed_id}})">{{li.comment_count}}</div>
								<div class="share_icon_img discuss" onclick="comment({{li.feed_id}})"></div>
								{{if li.is_fav}}
								<div class="share_icon count_{{li.feed_id}}" style="color:#e68d61">{{li.fav_count}}</div>
								{{/if}}
								{{if !li.is_fav}}
								<div class="share_icon count_{{li.feed_id}}">{{li.fav_count}}</div>
								{{/if}}
								<div class="share_icon_img encourage" id="{{li.feed_id}}" onclick="encourage({{li.feed_id}})">
										{{if li.is_fav}}
										<img src="img/encourage-h.png" data-role='1'>
										{{/if}}
										{{if !li.is_fav}}
										<img src="img/encourage.png" data-role='0'>
										{{/if}}
								</div>
							</div>
							<div class="cont_comment">
								<div class="fav_add_{{li.feed_id}}">
									{{if li.fav_list.length>0}}
									<div class="cont_comment_icon"></div>
									<div class="cont_comment_good">
										<div class="comment_good_img"></div>
										<span class="fav-content-{{li.feed_id}}">{{each li.fav_list as f a}}{{f}}、{{/each}}</span>
									</div>
									{{/if}}
							</div>
								<div class="cont_comment_details">
								<div class="comment_user comment_content_{{li.feed_id}}" onclick="comment({{li.feed_id}})">
										{{each li.comment as v n}}
											{{if n<2}}
											{{if v.comment_type==0 && !v.mid}}
													<div class="user_comment" >
											<span>{{v.member_name}}：</span>{{v.comment_content}}</div>
											{{/if}}
											{{if v.comment_type==1 && v.mid}}
											<div class="user_comment">
													<span>{{v.r_name}}</span>回复<span> &nbsp;{{v.member_name}}：</span>{{v.contents}}</div>
											{{/if}}
											{{/if}}
										{{/each}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{/each}}
			</script>
			<div class="support" style="margin-bottom:50px;display:none;">
					<span>技术支持：四川易家科技</span>
			</div>
	<footer class="footer">
		<li style="background-image: url(img/map.png);" onclick="javascript:window.location.href='map.html'">在线地图</li>
		<li class="footer_on" style="background-image: url(img/share-h.png);">分享榜</li>
		<li style="background-image: url(img/me.png);" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
	</footer>
	<script src="js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/swiper-4.2.0.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/template.js"></script>
	<script type="text/javascript" src="js/swiper-4.2.0.min.js"></script>
	<script type="text/javascript">
		//nav
		function click_nav(obj, n) {
			var index = $(obj).index();//序列号
			$(obj).addClass('nav_on').siblings().removeClass('nav_on');
			$(obj).find('div').addClass('nav_on_bottom');
			$(obj).siblings().find('div').removeClass('nav_on_bottom');
			listparamUL.type = n
			listparamUL.page = 1
			$('.container').html('')
			getList('.container', 'post', wrUrl + '/feed/feed_top', listparamUL, setList);
		}
		var h = window.screen.height;
		$('body').css({ "min-height": h });
		listparamUL = {
			type: 1,//1最热，2最新
			page: 1,
		};
		//获取图片的宽度和高度
		var code=GetUrlString('code')
		var allData=[]//存储所有数据
		var allImg=[]//存储轮播照片
	
		// 分页初始化

		getList('.container', 'post', wrUrl + '/feed/feed_top', listparamUL, setList);
		// 列表
		// 滑动请求更多
		$(window).scroll(function () {
			if (listparamUL.type == 2) {
				var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
				if ($(document).height() <= totalheight && !listLoading) {
					if (!listLoadingLock) {
						++listparamUL.page
						getList('.container', 'post', wrUrl + '/feed/feed_top', listparamUL, setList);

					} else if (listLoadingLock && listLoading) {
						$('.container').append('<div class="buy-load"><img class="load-img" src="img/load.png"><span class="load-tips">没有更多了~</span></div>');
					}
				}
			}
		})
		function setList(obj, res) {
			if (res.data.length == 0 && !listLoadingLock) {
				if (listparamUL.page == 1) {
					$('.support').hide()
					var h = '<div class="no-list"><img class="list-img" src="img/no_list.png"><div class="no-txt">逛逛其他的地方吧~</div></div>'
					$(obj).html(h)
				} else {				
					listLoadingLock = true
					tip.alert('没有更多了');
				}
			} else if (res.data.length != 0) {
				res.imgurl = imgURL
				res.type = listparamUL.type
				for (var i = 0; i < res.data.length; i++) {
					res.data[i].feed_ctime = timestampToTime(res.data[i].feed_ctime)
					for (var j = 0; j < res.data[i].fav_list.length; j++) {
						res.data[i].fav_list[j] = res.data[i].fav_list[j].member_name
					}
				}
			
				for(var m=0;m<res.data.length;m++){
					allData.push(res.data[m])
				}
				var html = template('list', res);
				$('.no-list').hide()
				$(obj).append(html);
				
				if($('.shareCont_user').length>1){
					$('.support').show()
				}
				}
				var width = $('.shareCont_user .user_cont .cont_imgs .cont_img').css('width');
	
		$('.shareCont_user .user_cont .cont_imgs .cont_img').css('height', width);
		}
		// 关注
		function collect(m_id, f_id) {
			var h = $('.follow_' + f_id).html()
			if (h == "关注") {
				getL(m_id, 'post', wrUrl + '/Follow/add', { follow_member_id: m_id }, setFollow);
			} else if (h == "已关注") {
				getL(m_id, 'post', wrUrl + '/Follow/del', { follow_member_id: m_id }, delFollow);
			}

		}
		function setFollow(obj, r) {
			if(r.code==200){
				tip.alert('关注成功');
			$('.memeber_' + obj).addClass('followed').html('已关注')
			}else{
				tip.alert(r.info);
			}
			
		}
		function delFollow(obj, r) {
			if(r.code==200){
				tip.alert('已取消关注');
			$('.memeber_' + obj).removeClass('followed').html('关注')
			}else{
				tip.alert(r.info);
			}
			
		}
		// 点赞
		function encourage(i) {
			
			content.is_fav = $('#' + i).find('img').attr('data-role')
			if (content.is_fav == 1) {
				// 取消点赞		
				getL(i, 'post', wrUrl + '/Fav/del', { feed_id: i }, delGood);
			} else if (content.is_fav == 0) {
				// 点赞	
				getL(i, 'post', wrUrl + '/Fav/add', { feed_id: i }, setGood);
			}
		}
		// 取消点赞
		function delGood(obj, r) {
		
			if (r.code == 200) {
				var html = "<img src='img/encourage.png' data-role='0'>"
				$('#' + obj).html(html)
				var num = parseInt($('.count_' + obj).html())
				num--
				$('.count_' + obj).html(num).css({ 'color': '#000' })
				var r = $('.fav-content-' + obj).html().replace(r.data.member_name + "、", "")
				if (r != '') {
					$('.fav-content-' + obj).html(r)
				} else {

					$('.fav_add_' + obj).html("")
				}
				tip.alert('已取消点赞');
			} else {
				tip.flag('请求错误！', 'error');
			}
		}
		function setGood(obj, r) {
			
			if (r.code == 200) {
				if ($('.fav-content-' + obj).html()) {
					var list = r.data.member_name + '、' + $('.fav-content-' + obj).html()
				} else {
					var list = r.data.member_name + '、'
				}
				var m = '<div class="cont_comment_icon"></div><div class="cont_comment_good"><div class="comment_good_img"></div><span class="fav-content-' + obj + '">' + list + '</span></div>'
				
				$('.fav_add_' + obj).html(m)
				var html = '<img src="img/encourage-h.png" data-role="1">'
				$('#' + obj).html(html)
				var num = parseInt($('.count_' + obj).html())
				num++
				$('.count_' + obj).html(num).css({ 'color': '#e4393c' })
				$('#' + obj).append("<span class='num'>" + '+1' + "</span>");
				var box = $(".num");
				var left = 25;
				var top = -20;
				box.css({
					"position": "absolute",
					"left": left + "px",
					"top": top + "px",
					"z-index": 9999,
					"font-size": 20,
					"color": '#e4393c'
				})
				box.animate({
					"font-size": 10,
					"opacity": "0",
					"top": top - 30 + "px"
				}, 500, function () {
					box.remove();

				})

			} else if (r.code == 500) {
				return
			} else {
				tip.flag('请求错误！', 'error');
			}
		}
		// 回复整个评论
		var content = {
			txt: '',
			name: '',
			type: 1,
			f_id: '',
			c_id: '',
			oName: '',
			is_fav: false//是否点赞
		}
		function comment(id) {
			// content.type = 1
			content.f_id = id
			// $('.ui-dialog').addClass('show')
			window.location.href='shareDetails.html?id='+content.f_id
		}

		$('.my_swiper').click(function () {
			$('.my_swiper').html('')
		})
		function nofind() {
		var img = event.srcElement;
		img.src = "img/img_error.png";
		img.onerror = null;
	}	
	</script>
</body>

</html>