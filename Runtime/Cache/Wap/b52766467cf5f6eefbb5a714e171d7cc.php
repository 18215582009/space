<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title><?php echo ($meta_title); ?> | </title>
		<link href="/Public/Wap/css/weui.min.css" rel="stylesheet" />
		<link href="/Public/Wap/css/common.css" rel="stylesheet" />
		<style type="text/css">
			.hd {
			    padding: 2em 0;
			}
			.cell .bd {
			    padding-bottom: 30px;
			}		
			.cell .page_title {
			    color: #225fba;
			}
			.page_title {
			    text-align: center;
			    font-size: 34px;
			    color: #3cc51f;
			    font-weight: 400;
			    margin: 0 15%;
			}			
		</style>
		
	</head>
	<body>
		<div class="container">
			
	<div class="cell">
		<div class="hd">
			<h1 class="page_title">Login</h1>
		</div>
		<div class="bd">
			<form action="/Wap/Account/login.html" method="post">
				<div class="weui_cells weui_cells_form">
					<div class="weui_cell">
						<div class="weui_cell_hd">
							<label class="weui_label">账号</label>
						</div>
						<div class="weui_cell_bd weui_cell_primary">
							<input class="weui_input" type="text" name="username" placeholder="请输入账号">
						</div>
					</div>
					<div class="weui_cell">
						<div class="weui_cell_hd">
							<label class="weui_label">密码</label>
						</div>
						<div class="weui_cell_bd weui_cell_primary">
							<input class="weui_input" type="password" name="password" placeholder="请输入密码">
						</div>
					</div>				
					<div class="weui_cell weui_vcode">
						<div class="weui_cell_hd">
							<label class="weui_label">验证码</label>
						</div>
						<div class="weui_cell_bd weui_cell_primary">
							<input class="weui_input" type="number" name="verify" placeholder="请输入验证码">
						</div>
						<a href="javascript:;" class="weui_cell_ft reloadVerify">
							<img src="<?php echo U('Account/verify');?>" class="verifyImg">
						</a>
					</div>
				</div>
				<div class="weui_btn_area">
				    <button class="weui_btn weui_btn_primary" type="submit">确定</button>
				</div>
			</form>
		</div>
	</div>

		</div>		

		<script src="/Public/Wap/js/jquery-2.1.4.min.js"></script>
		<script src="/Public/Wap/js/fastclick.min.js"></script>
		<script src="/Public/Wap/js/weui.min.js"></script>
		
	<script>
		$(function(){
			$('body').on('click', '.reloadVerify', function(){
	            var verifyimg = $(".verifyImg").attr("src");
	            if (verifyimg.indexOf('?') > 0) {
	                $(".verifyImg").attr("src", verifyimg + '&random=' + Math.random());
	            } else {
	                $(".verifyImg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
	            }
			});
		});
	</script>

	</body>
</html>