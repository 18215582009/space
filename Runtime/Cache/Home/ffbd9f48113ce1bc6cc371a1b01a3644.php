<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/swiper-4.2.0.min.css" />
	<!-- <link rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/2.0.0/css/frozen.css"> -->
	<title>126+分享详情</title>
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

		.followed {
			position: absolute;
			bottom: 3px;
			right: 0;
			min-width: 35px;
			height: 20px;
			border-radius: 2px;
			text-align: center;
			font-size: 12px;
			text-align: center;
			line-height: 20px;
			background: #fff !important;
			color: #e68d61 !important;
		}
	</style>
</head>

<body style="background-color: #eeeeee;">
	<!-- <div class="ui-dialog">
		<div class="ui-dialog-cnt">
			<div class="ui-dialog-bd">
				<h3>回复</h3>
				<input type="text" style="border:1px solid #aaa" class="my_input">
			</div>
			<div class="ui-dialog-ft">
				<button type="button" data-role="button" class="btn-colse" onclick="colse()">取消</button>
				<button type="button" data-role="button" class="btn-recommand" onclick="submit()">提交</button>
			</div>
		</div>
	</div> -->
	<!-- 轮播 -->
	<div class="my_swiper">
		<div class="y_tiping">
			<div class="swiper-container">
				<div class="swiper-wrapper">

				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
	<div class="container">

	</div>
	<script type="text/template" id="info">
			<div class="shareCont_user">	
				<div class="user_header">
					<div class="header_img" onclick="javascript:window.location.href='person.html?id='+{{data.member.member_id}}"><img src="{{data.member.headimgurl}}" alt=""/></div>
					<div class="header_cont">
						<div  class="header_cont_name">{{data.member.member_name}}</div>
						<div class="header_cont_date">{{data.feed_utime}}</div>
					</div>
					<div class="my_follow">
							{{if data.is_follow}}
							<div class="header_button followed" onclick="toggleFollow({{data.member_id}})">已关注</div>
							{{/if}}
							{{if !data.is_follow}}
							<div class="header_button " onclick="toggleFollow({{data.member_id}})">关注</div>
							{{/if}}
					</div>
					
				</div>
				
				<div class="user_cont">
					<div class="cont_text">
						{{data.feed_content}}
					</div>
					<div class="cont_imgs">
						
						{{if data.pics_url.length==1}}
						<div class="details_long_img"  onclick="toDetailsSweiper({{data.feed_id}},'0')"><img src="{{data.pics_url[0]}}" alt=""></div>
						{{else}}
							{{each data.pics_url as v a}}
						<div class="cont_img" style="background:url({{v}});background-repeat: no-repeat;background-position: center;background-size:100%;background-size: cover;" onclick="toDetailsSweiper({{data.feed_id}},{{a}})">
									
						</div>
						{{/each}}
						{{/if}}		
					</div>
					<div class="cont_icon">
						<span>【{{data.feed_title}}】</span>
						<div class="share_icon share_icon_last-child">{{data.comment_count}}</div>
						<div class="share_icon_img discuss" onclick="comment({{data.feed_id}})"></div>
						{{if !data.is_fav}}
						<div class="share_icon fav_count">{{data.fav_count}}</div>
						{{/if}}
						{{if data.is_fav}}
						<div class="share_icon fav_count" style="color:#e68d61;">{{data.fav_count}}</div>
						{{/if}}			
						<div class="share_icon_img encourage"   onclick="encourage({{data.feed_id}})">
								{{if data.is_fav}}
								<img src="img/encourage-h.png" data-role='1'>
								{{/if}}
								{{if !data.is_fav}}
								<img src="img/encourage.png" data-role='0'>
								{{/if}}
						</div>
					</div>
					<div class="cont_comment">
						<div class="fav_add">
							{{if data.fav_list.length>0}}
						<div class="cont_comment_icon"></div>
						<div class="cont_comment_good">
							<div class="comment_good_img"></div>
							<span class="fav-content">{{each data.fav_list as f a}}{{f}}、{{/each}}</span>			
						</div>
						{{/if}}
					</div>
						<div class="cont_comment_details">
							<div class="comment_user">
									{{each data.comment as v n}}				
										{{if v.comment_type==0 && !v.mid}}
												<div class="user_comment" onclick='toReply({{data.feed_id}},{{v.comment_id}},"{{v.member_name}}")')>
										<span>{{v.member_name}}：</span>{{v.comment_content}}
									</div>
										{{/if}}
										{{if v.comment_type==1 && v.mid}}
										<div class="user_comment" onclick='toReply({{data.feed_id}},{{v.rc_id}},"{{v.r_name}}")'>
												<span>{{v.r_name}}</span>回复<span> &nbsp;{{v.member_name}}：</span>{{v.contents}}</div>
										{{/if}}			
									{{/each}}
								</div>
						</div>
					</div>
				</div>
			</div>
		</script>
</body>
<script src="js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript" src="js/swiper-4.2.0.min.js"></script>
<script type="text/javascript">
	//获取图片的宽度和高度
	var allData = {}//存储所有数据
	var allImg = []//存储轮播照片
	
	var i = GetUrlString('id')
	getL('.container', 'post', wrUrl + '/Feed/info', { id: i }, getList);
	function getList(obj, r) {
		r.data.feed_utime = timestampToTime(r.data.feed_utime)
		for (var i = 0; i < r.data.fav_list.length; i++) {
			r.data.fav_list[i] = r.data.fav_list[i].member_name
		}
		r.data.imgurl = imgURL
		allData = r.data
		var html = template('info', r);
		$(obj).html(html);
		var width = $('.shareCont_user .user_cont .cont_imgs .cont_img').css('width');
	$('.shareCont_user .user_cont .cont_imgs .cont_img').css('height', width);
	}

	// 重写轮播
	function toDetailsSweiper(n, i) {
		var addHtml = "<div class='y_tiping'>"
		addHtml += "<div class='swiper-container'>"
		addHtml += "<div class='swiper-wrapper'>"
		addHtml += "</div>"
		addHtml += "<div class='swiper-pagination'></div>"
		addHtml += "</div>"
		addHtml += "</div>"
		$('.my_swiper').html(addHtml)
		$('.swiper-wrapper').html('')

		$('.my_swiper .y_tiping').show()
		for (var h = 0; h < allData.pics_url.length; h++) {
			var html = "<div class='swiper-slide display_flex justify-content_flex-center align-items_center'><img src='" + allData.pics_url[h] + "' alt=''></div>"
			$('.swiper-wrapper').append(html)
		}
		showSweiper(i)

	}
	function nofind() {
		var img = event.srcElement;
		img.src = "img/img_error.png";
		img.onerror = null;
	}
	function toggleFollow(m_id) {
		var h = $('.header_button').html()
		if (h == "关注") {
			getL('.header_button', 'post', wrUrl + '/Follow/add', { follow_member_id: m_id }, setFollow);
		} else if (h == "已关注") {
			getL('.header_button', 'post', wrUrl + '/Follow/del', { follow_member_id: m_id }, delFollow);
		}
	}
	// 关注
	function setFollow(obj, r) {
			if(r.code==200){
				tip.alert('关注成功');
			$(obj).addClass('followed').html('已关注')
			}else{
				tip.alert(r.info);
			}	
		}
		function delFollow(obj, r) {		
			if(r.code==200){
				tip.alert('已取消关注');
			$(obj).removeClass('followed').html('关注')
			}else{
				tip.alert(r.info);
			}
		}
	function encourage(i) {
		var is_fav = $('.encourage').find('img').attr('data-role')
		if (is_fav == 1) {
			// 取消点赞		
			getL('.encourage', 'post', wrUrl + '/Fav/del', { feed_id: i }, delGood);
		} else if (is_fav == 0) {
			// 点赞	
			getL('.encourage', 'post', wrUrl + '/Fav/add', { feed_id: i }, setGood);
		}
	}

	function delGood(obj, r) {
		if (r.code == 200) {
			var html = "<img src='img/encourage.png' data-role='0'>"
			$(obj).html(html)
			var num = parseInt($('.fav_count').html())
			num--
			$('.fav_count').html(num).css({ 'color': '#000' })
			var r = $('.fav-content').html().replace(r.data.member_name + "、", "")
			if (r != '') {
				$('.fav-content').html(r)
			} else {
				$('.fav_add').html("")
			}
			tip.alert('已取消点赞');
		} else {
			tip.flag('请求错误！', 'error');
		}
	}

	function setGood(obj, r) {
		if (r.code == 200) {
			var html = '<img src="img/encourage-h.png" data-role="1">'
			$(obj).html(html)
			var num = parseInt($('.fav_count').html())
			num++
			$('.fav_count').html(num).css({ 'color': '#e4393c' })
			// 点赞成功添加文字
			var list = r.data.member_name + '、' + $('.fav-content').html()
			$('.fav-content').html(list)
			$(obj).append("<span class='num'>" + '+1' + "</span>");
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
			}, 600, function () {
				box.remove();
			})

		} else if (r.code == 500) {
			return
		} else {
			tip.flag('请求错误！', 'error');
		}
	}
	// 回复
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
		content.type = 1
		content.f_id = id
		// $('.ui-dialog').addClass('show')
		window.location.href='comment.html?feed_id='+content.f_id+'&content_type='+content.type
	}
	function submit() {
		var input_value = $('.my_input').val()
		content.txt = input_value
		if (input_value) {
			colse()
			if (content.type == 1) {
				getL('.share_icon_last-child', 'post', wrUrl + '/feed/comment', { feed_id: content.f_id, comment_content: input_value, content_type: 0 }, setCommentNum);
			} else {
				getL('.comment_user', 'post', wrUrl + '/feed/comment', { feed_id: content.f_id, comment_id: content.c_id, comment_content: input_value, content_type: 1 }, setReply);
			}
		} else {
			colse()
		}
	}
	function toReply(f_id, c_id, name) {
		content.f_id = f_id
		content.c_id = c_id
		content.name = name
		content.type = 2
		// $('.ui-dialog').addClass('show')
		window.location.href='comment.html?feed_id='+content.f_id+'&content_type='+content.type+'&comment_id='+content.c_id
	}
	// 写入回复
	function setReply(obj, r) {
		if (r.code == 200) {
			setCommentContent('.comment_user', 2, content.txt, r.data.member_name, content.name)
		} else {
			tip.flag(r.info, 'error');
		}
	}
	// 写入评论内容
	function setCommentContent(obj, type, cont, myName, oName) {
		if (type == 1) {
			var html = "<div class='user_comment'><span>" + myName + ":</span>" + cont + "</div>"
			$(obj).append(html)
			content.txt = ''
		} else {
			var html = "<div class='user_comment'><span>" + myName + "</span>回复<span>" + oName + ":</span>" + cont + "</div>"
			$(obj).append(html)
			content.txt = ''
		}

	}
	function setCommentNum(obj, r) {
		if (r.code == 200) {
			var num = parseInt($(obj).html())
			num++
			$(obj).html(num)
			setCommentContent('.comment_user', 1, content.txt, r.data.member_name)
		} else {

			tip.flag('请求错误！', 'error');
		}

	}
	function colse() {
		$('.ui-dialog').removeClass('show')
	}
	$('.my_swiper').click(function () {
		$('.my_swiper').html('')
	})
</script>


</html>