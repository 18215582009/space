$(function() {
	$(".l").click(function(){
		var i=$(this).index();
		$(".menu").show();
		$(".menu li").eq(i).css("background-color","e68d61");
	});
})