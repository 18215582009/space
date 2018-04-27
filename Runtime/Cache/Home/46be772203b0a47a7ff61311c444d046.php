<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<title>126+消息列表</title>
	<meta charset="utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/amazeui.min.css" />
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
  .message-list{
    margin:15px;
  }
</style>

<body>
    <div class="message-container">
           
    </div>
    <script type="text/template" id="list">
     {{if data.message_list.length>0 }}
     {{each data.message_list as li i}}
     {{if li.is_read==0&&li.member}}
     <div>
        <article class="am-comment message-list">
            <a href="person.html?id={{li.member.member_id}}">
              <img src="{{li.member.headimgurl}}" alt="" class="am-comment-avatar" width="48" height="48" onerror="nofind()">
            </a>     
            <div class="am-comment-main" onclick="javascript:window.location.href='shareDetails.html?id='+{{li.content.args.feed_id}}">
              <header class="am-comment-hd">
              
                <div class="am-comment-meta">
                  <a href="#link-to-user" class="am-comment-author">{{li.member.member_name}}</a>
                  <time datetime="{{li.ctime}}" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">{{li.ctime}}</time>
                </div>
              </header>
              <div class="am-comment-bd" style="font-size:14px;">
               {{li.content.content}}
              </div>
            </div>
          </article>
     </div>
     {{/if}}
    {{/each}}
     {{/if}}
     {{if data.message_list.length==0}}
     <div class="no-list"><img class="list-img" src="img/mes.png"><div class="no-txt">什么都没有，空空如也~</div></div>
     {{/if}}
    </script>
    <!-- <div class="no-list"><img class="list-img" src="img/mes.png"><div class="no-txt">你还没有任何私信哦~</div></div> -->
</body>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/template.js"></script>
<script type="text/javascript">
      $(function(){
        var i=GetUrlString('id')
    	getL('.message-container', 'post', wrUrl + '/Message/page', {member_id:i}, getList);
	function getList(obj, r) {
    r.imgurl = imgURL
		var html = template('list', r);
    $(obj).html(html);
  }

      })
      function nofind() {
		var img = event.srcElement;
		img.src = "img/img_error.png";
		img.onerror = null;
	}
</script>

</html>