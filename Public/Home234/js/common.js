	//Activate fast click
	if (typeof FastClick != 'undefined') {
		FastClick.attach(document.body);
	}

	// 无限滚动,加载更多
	var infiniteScroll = function(callback){
		callback  = callback || $.noop;
		
		$('.scroll').on('scroll', function(e){
			var contentHeight = this.offsetHeight;
			var scrollHeight  = this.scrollHeight;
			
			var topHeight = $(this).scrollTop();
			var distance  = $(this).data('distance') || 50;
			
			if((topHeight + contentHeight + distance) >= scrollHeight){
				return callback();
			}
		});
	}

	
    // .container 设置了 overflow 属性, 导致 Android 手机下输入框获取焦点时, 输入法挡住输入框的 bug
    // 相关 issue: https://github.com/weui/weui/issues/15
    // 解决方法:
    // 0. .container 去掉 overflow 属性, 但此 demo 下会引发别的问题
    // 1. 参考 http://stackoverflow.com/questions/23757345/android-does-not-correctly-scroll-on-input-focus-if-not-body-element
    //    Android 手机下, input 或 textarea 元素聚焦时, 主动滚一把
    if (/Android/gi.test(navigator.userAgent)) {
        window.addEventListener('resize', function () {
            if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
                window.setTimeout(function () {
                    document.activeElement.scrollIntoViewIfNeeded();
                }, 0);
            }
        })
    }	
    
	// 查看大图
	$('body').on('click', '.imgsView', function(){
		
		history.pushState(null, "", "#showPic");
		
		var pics = $(this).data('pics');
			pics = pics.split(',');
			
		var html = '';
			html += '<div class="image-view">';
//			html +=   '<a class="mack_close" href="javascript:history.back();"></a>';
			html +=   '<div class="swiper-container">';
			html +=     '<div class="swiper-wrapper">';
		for(i in pics){
			html += '<div class="swiper-slide">';
			html +=   '<div class="pinch-zoom">';
			html +=      '<img src="'+pics[i]+'" />';
			html +=    '</div>';
			html += '</div>';
		}	
			html +=     '</div>';
			html +=     '<div class="swiper-pagination"></div>';
			html +=   '</div>';
			html += '</div>';
			
		$('body').append(html);
		
        $('.image-view .pinch-zoom').each(function () {
            new RTP.PinchZoom($(this), {});
        });
		
		new Swiper('.image-view .swiper-container', {
		    pagination: '.swiper-pagination',
		    paginationClickable: true
		});			
		
//		var html = '';
//			html += '<div class="mack"><a class="mack_close" href="javascript:window.history.back();"></a>';
//			html += '<div class="swiper-container swiper-b">';
//			html += '<div class="swiper-wrapper">';
//		for(i in pics){
//			html += '<div class="swiper-slide" style="background-image:url('+pics[i]+')"></div>';
//		}
//			html += '</div><div class="swiper-pagination"></div></div></div>';
		
//		$('body').append(html);
//		
//		new Swiper('.swiper-b', {
//	        pagination: '.swiper-pagination',
//			paginationClickable: true,
//		});
	});

	// 返回键关闭查看大图
	$(window).on('popstate', function(event){
//		$(".mack").remove();
		$(".image-view").fadeOut("fast",function(){
			$(".image-view").remove();
		 });
	});
	
	$('body').on('click', '.image-view', function(){
//		$(".image-view").remove();
		history.back();
	});
	
	// 分享sheet
	$('body').on('click', '.feedSheet', function(){
		var isSelf = $(this).data('is-self');
		var feedId = $(this).data('feed-id');
		var $this  = $(this);
		
		var obj = [];
		
		if(isSelf){
			
			obj.push({
				label: '删除',
				onClick: function(){
					$.weui.confirm('确认删除?', function(){
						$.weui.loading();
						
						$.ajax({
							type:"post",
							dataType:"json",
							url:"/feed/del",
							data: {
								feed_id: feedId,
							},
							success: function(result){
								$.weui.hideLoading();
								
								if(result.status){
									$.weui.toast(result.info, function(){
										$this.closest('.comment_unit').remove();
									});
								}else{
									$.weui.alert(result.info);
								}
							},
							error: function(){
								$.weui.hideLoading();
								
								$.weui.toast('网络错误');
							}
						});
					});
				}
			});
		}
		
		$.weui.actionSheet(obj);
	});
	
