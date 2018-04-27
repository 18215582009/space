// // JavaScript Document

//存储本地缓存

var token = localStorage.getItem("token");

var root = 'http://47.92.97.86:8081';

// var ajaxUrl = 'http://xiewen.ejar.online/index.php/home/category';
var ajaxUrl = 'http://126j.ejar.com.cn/index.php/home/category';
var imgURL='http://126j.ejar.com.cn';
var wrUrl='http://126wenren.ejar.com.cn'

//var ajaxUrl = 'http://39.104.60.138:8080/shop';
//function getLoginToken() {
//	return localStorage.getItem("token");
//}

////var token="ace07c52dc6139093180b4b226cbf540";
//function setLoginToken(user) {
//	localStorage.setItem("token", user);
//}
//分页初始化变量
var obj = '.content',
	totalheight = '',
	listLoading = false,
	listLoadingLock = false,
	currentpage = 0;

//请求参数
// var listparam = {
// 	'pageNo': currentpage,
// 	'pageSize': 10
// };

/*数据请求
    obj：内容填充对象
    objtpl：内容填充
    type：请求方式
    url：请求接口
    listparam，param：请求参数
    callback:数据回调
*/
// 上传图片
function uploadImg(obj){
		var file = obj.files[0];
		var r = new FileReader();
		r.readAsDataURL(file);
		var me=obj;
		$(r).load(function(){
			dealImage(this.result, {
				width : 500
			}, function(base){
				$(obj).attr('value',base);
				  changImg(base);
	 
			})
		});
	}
	function changImg(base){
		var imgbase = base
		getInfo('post','/feed/uploadImgbs',{"imgs":imgbase},setImg)
	}
	function setImg(e){
			var src=e.data.url;
			$(".add-img").before('<li class="dc-add-img"><img  src=" '+ src +' " alt=""><span class="dc-del" onclick="delimg(this)">×</span><input type="hidden" name="imgs" class="inpval" value="'+ src +'"></li>')
	}
	//压缩图片
	function dealImage(path, obj, callback){
		var img = new Image();
		img.src = path;
		img.onload = function(){
			var that = this;
			// 默认按比例压缩
			var w = that.width,
				h = that.height,
				scale = w / h;
			w = obj.width || w;
			h = obj.height || (w / scale);
			var quality = 1;        // 默认图片质量为0.7
			//生成canvas
			var canvas = document.createElement('canvas');
			var ctx = canvas.getContext('2d');
			// 创建属性节点
			var anw = document.createAttribute("width");
			anw.nodeValue = w;
			var anh = document.createAttribute("height");
			anh.nodeValue = h;
			canvas.setAttributeNode(anw);
			canvas.setAttributeNode(anh);
			ctx.drawImage(that, 0, 0, w, h);
			// 图像质量
			if(obj.quality && obj.quality <= 1 && obj.quality > 0){
				quality = obj.quality;
			}
			// quality值越小，所绘制出的图像越模糊
			var base64 = canvas.toDataURL('image/jpeg', quality );
			// 回调函数返回base64的值
			callback(base64);
		}
	}
//针对需要分页的数据类型
function getList(obj, type, url, listparam, callback) {
	
		currentpage = parseInt(currentpage);
		if(currentpage === 0) {
			currentpage = 1;
			$(obj).html('');
		}
		//http wait
		listLoading = true;
		$.ajax({
			type: type,
			url: url,
			data: listparam,
			dataType: 'json',
			contentType:'application/x-www-form-urlencoded',
			success: function(r) {
				if(r.code == 201) {
					tip.flag('请先登录', 'error');
					setTimeout(function() {
						location.href = '';
					}, 2000);
				} else if(r.code == 200) {
					listLoading = false;
					callback(obj, r);
				} else {
					tip.flag(r.info, 'error');
				}
			},
			error: function() {
				tip.flag('请求错误！', 'error');
			}
		})
	}

//针对获取信息的数据类型
function getInfo(type, url, param, callback) {
	$.ajax({
		type: type,
		url: url,
		data: param,
        dataType: 'json',
        contentType:'application/x-www-form-urlencoded',
		success: function(r) {
          callback(r)
		},
		error: function(r) {
			// callback(r)
			tip.flag('请求错误！', 'error');
		}
	})
}
//后台专用
function getL(obj, type, url, params, callback) {
   
	$.ajax({
		type: type,
		url: url,
		data: params,
		dataType: 'json',
		contentType:'application/x-www-form-urlencoded',
		success: function(r) {	
				callback(obj, r);
		
		},
		error: function() {
			tip.flag('请求错误！', 'error');
		}
	})
}

//滚动加载更多
function scrollMore(obj, objtpl, type, url, listparam, dataobj) {
	$(obj).scroll(function() {
		
		totalheight = parseFloat($(obj).height()) + parseFloat($(obj).scrollTop());
		if($(obj).height() <= totalheight && !listLoading) {
			++currentpage;
			getList(obj, objtpl, type, url, listparam, dataobj);
		}
	});
}

/*提示框
    content:提示内容
    icon:显示图标（success，error）
*/
var tip = {
	flag: function(content, icon) {
		var width = 120;
		var height = 110;
		var icon = 'img/' + icon + '.png';
		var node = $("<div class='_tiping' style='background-image:url(" + icon + ") '>" + content + "</div>");
		$('body').append(node);
		node.css({
			left: ($(window).width() - width) / 2,
			top: ($(window).height() - height) / 2,
			height: height,
			lineHeight: height + 60 + 'px'
		});
		$('._tiping').fadeOut(3000, function() {
			$('._tiping').remove();
		});
	},
	code: function(content, icon) {
		var width = 120;
		var height = 110;
		var icon = 'img/' + icon + '.png';
		var node = $("<div class='_tiping_code'><img src='"+icon+"'> " + "<div>"+content +"</div></div>");
		$('body').append(node);
		
		// $('._tiping').fadeOut(3000, function() {
		// 	$('._tiping').remove();
		// });
	},
	alert:function(content){
		var width = 120;
		var height = 35;
		var node = $("<div class='_tiping_alert'>" + content + "</div>");
		$('body').append(node);
		node.css({
			left: ($(window).width() - width) / 2,
			top: ($(window).height() - height) / 2,
			height: height,
			lineHeight: height+'px'
		});
		$('._tiping_alert').fadeOut(3000, function() {
			$('._tiping_alert').remove();
		});
	}
};

/*获取地址栏参数
    name:地址栏参数名
*/
function GetUrlString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if(r != null) return unescape(r[2]);
	return '';
}
// 轮播
function  toSweiper(n,i){
	var addHtml="<div class='y_tiping'>"
	addHtml+="<div class='swiper-container'>"
		addHtml+="<div class='swiper-wrapper'>"
			addHtml+="</div>"
			addHtml+="<div class='swiper-pagination'></div>"
			addHtml+="</div>"
			addHtml+="</div>"
	$('.my_swiper').html(addHtml)
	$('.swiper-wrapper').html('')
	for(var j=0;j<allData.length;j++){
		if(n==allData[j].feed_id){
			allImg=allData[j].pics_url
		}
	}
	$('.my_swiper .y_tiping').show()
	for(var h=0;h<allImg.length;h++){
		var html="<div class='swiper-slide display_flex justify-content_flex-center align-items_center'><img src='"+allImg[h]+"' alt=''></div>"
		$('.swiper-wrapper').append(html)
	}
	showSweiper(i)
	
}

function showSweiper(i){
var mySwiper = new Swiper('.swiper-container', {
	autoplay: false,//可选选项，自动滑动
	initialSlide: i,//设置初始化Index
	pagination: {
	el: '.swiper-pagination',
	type: 'bullets',
	  }
})
}
//时间格式化
function timestampToTime(timestamp) {
	var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
	Y = date.getFullYear() + '-';
	M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
	D = date.getDate() + ' ';
	h = date.getHours() + ':';
	m = date.getMinutes();
	if(m<10){
		m='0'+m
	}	
	s = date.getSeconds();
	if(s<10){
		s='0'+s
	}
	return Y+M+D+h + m
}
function timestampToTimeNom(timestamp) {
	var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
	Y = date.getFullYear() + '.';
	M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '.';
	D = date.getDate() + ' ';
	h = date.getHours() + ':';
	m = date.getMinutes();
	if(m<10){
		m='0'+m
	}	
	s = date.getSeconds();
	if(s<10){
		s='0'+s
	}
	return Y+M+D
}

//关联显示
function connectDisplay(obj, type, val) {
	// obj: 所有选择对象类名，id名
	// type: 所有选择对象的属性值
	// val: 要选择的属性值
	$(obj).each(function() {
		if($(this).attr(type) == val) {
			$(this).css("display", "block");
		} else {
			$(this).css("display", "none");
		}
	})
}

function setupWebViewJavascriptBridge(callback) {
	//iOS使用
	if(window.WebViewJavascriptBridge) {
		return callback(WebViewJavascriptBridge);
	}
	if(window.WVJBCallbacks) {
		return window.WVJBCallbacks.push(callback);
	}
	window.WVJBCallbacks = [callback];
	var WVJBIframe = document.createElement('iframe');
	WVJBIframe.style.display = 'none';
	WVJBIframe.src = 'wvjbscheme://__BRIDGE_LOADED__';
	document.documentElement.appendChild(WVJBIframe);
	setTimeout(function() {
		document.documentElement.removeChild(WVJBIframe)
	}, 0)
	//Android使用
	if(window.WebViewJavascriptBridge) {
		return callback(WebViewJavascriptBridge)
	} else {
		document.addEventListener(
			'WebViewJavascriptBridgeReady',
			function() {
				return callback(WebViewJavascriptBridge)
			},
			false
		);
	}
}

var head = document.head || document.getElementsByTagName('head')[0];
head.append('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />');

var pageAll = {//后台所有分页
	yu: '', //总页数
	chang: function(pageType, obj, type, url, listparam, callback) { //上一页，下一页
		if(pageType === '0') { //上一页
			listparam.pageNo -= 1;
			if(listparam.pageNo <= 0) {
				layer.msg('没有上一页了！', {
					time: 1000,
				});
				listparam.pageNo = 1;
			} else {
				getL(obj, type, url, listparam, callback);
			}
		} else if(pageType === '1') { //下一页
			listparam.pageNo += 1;
			if(listparam.pageNo > pageAll.yu) {
				layer.msg('没有下一页了！', {
					time: 1000,
				});
				listparam.pageNo = pageAll.yu;
			} else {
				getL(obj, type, url, listparam, callback);
			}

		} else if(pageType === '2') { //初始请求

			getL(obj, type, url, listparam, callback);
		}
	},
	writeTotal: function(pageNo, pageSize, count) { //打印出总页数和当前页数
		pageAll.yu = parseInt(count / pageSize);
		if(count % pageSize != 0) {
			pageAll.yu += 1;
		}

		var pageHtml = '<a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">';
		pageHtml += pageNo + '/' + pageAll.yu
		pageHtml += '</a>';

		$("#DataTables_Table_0_paginate").find('span').html(pageHtml);
	}

}
function wxShare(img,dect){
	var url = location.href.split('#').toString();//url不能写死
	var a={'url':url}
	
	$.ajax({
		type: 'post',
		url: '/WeConf/get_WeiConfig',
		data: a,
		dataType: 'json',
		contentType:'application/x-www-form-urlencoded',
		success: function(r) {
			wx.config({
                debug: false,////生产环境需要关闭debug模式
                appId: r.data.appId,//appId通过微信服务号后台查看
                timestamp: r.data.timestamp,//生成签名的时间戳
                nonceStr: r.data.nonceStr,//生成签名的随机字符串
                signature: r.data.signature,//签名
                jsApiList: [//需要调用的JS接口列表
                    'checkJsApi',//判断当前客户端版本是否支持指定JS接口
                    'onMenuShareTimeline',//分享给好友
                    'onMenuShareAppMessage'//分享到朋友圈
                ]
			});	
			wx.ready(function () {
				var link = window.location.href;
				var protocol = window.location.protocol;
				var host = window.location.host;
				var tit=document.title;
				var imgurl,content
				if(img){
					imgurl=img
				}else{
					imgurl='http://126wenren.ejar.com.cn/index/img/img_error.png'
				}
				if(dect){
					content=dect
				}else{
					content='126+更多精彩等着你~'
				}
				//分享朋友圈
				wx.onMenuShareTimeline({
					title: tit,
					link: link,
					imgUrl: imgurl,// 自定义图标
					trigger: function (res) {
						// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回.
						//alert('click shared');
					},
					success: function (res) {
						
						//some thing you should do
					},
					cancel: function (res) {
						
					},
					fail: function (res) {
						//alert(JSON.stringify(res));
					}
				});
				//分享给好友
				wx.onMenuShareAppMessage({
					title: tit, // 分享标题
					desc: content, // 分享描述
					link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: imgurl, // 自定义图标
					type: 'link', // 分享类型,music、video或link，不填默认为link
					dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
					success: function (res) {
						
						//some thing you should do
					},
					cancel: function (res) {
						
					},
				});
				wx.error(function (res) {
					
				});
			});
		},
		error: function() {
			tip.flag('请求错误！', 'error');
		}
	})
}
var originalHeight=document.documentElement.clientHeight || document.body.clientHeight;

window.onresize=function(){

    //软键盘弹起与隐藏  都会引起窗口的高度发生变化
    var  resizeHeight=document.documentElement.clientHeight || document.body.clientHeight;

    if(resizeHeight*1<originalHeight*1){ 
	
		//resizeHeight<originalHeight证明窗口被挤压了
            plus.webview.currentWebview().setStyle({
                height:originalHeight
            });

      }
}

	// $('.y_input').on('click', function () {
	//  var target = this;
	//  console.log('input被点击')
	//   // 使用定时器是为了让输入框上滑时更加自然
	//   setTimeout(function(){
	//  //   target.scrollIntoView(true);
	//  window.scrollTo(0,document.body.offsetHeight);
	//  },100);
	// });
 function wxCode(){
	var url = location.href.split('#').toString();//url不能写死
	var a={'url':url}
	
	$.ajax({
		type: 'post',
		url: '/WeConf/get_WeiConfig',
		data: a,
		dataType: 'json',
		contentType:'application/x-www-form-urlencoded',
		success: function(r) {
			wx.config({
                debug: false,////生产环境需要关闭debug模式
                appId: r.data.appId,//appId通过微信服务号后台查看
                timestamp: r.data.timestamp,//生成签名的时间戳
                nonceStr: r.data.nonceStr,//生成签名的随机字符串
                signature: r.data.signature,//签名
                jsApiList: [//需要调用的JS接口列表
                    'checkJsApi',//判断当前客户端版本是否支持指定JS接口
                    'scanQRCode'    
                ]
			});	
			wx.ready(function () {
				wx.ready(function() {
					wx.scanQRCode({   
						needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
						scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
						success: function (res) {
					
							console.log(res);
							window.location.href='check-list.html'
							//其它网页调用二维码扫描结果： 
							//var result=sessionStorage.getItem('saomiao_result');
						}
					});
				});
				wx.error(function (res) {
					tip.flag(res, 'error');
				});

			})
		},
		error: function() {
			tip.flag('请求错误！', 'error');
		}
	})
}