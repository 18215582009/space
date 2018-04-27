<?php
namespace Home\Controller;
use Think\Controller;
use Common\Controller\ErrorCodeController;
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
class WeConfController extends Controller{
    /**
     * 收藏点赞--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  del
     * @param $feed_id   分享id
     * @param 
     */
    public function get_WeiConfig(){
    	print_r(C('WECHAT'));exit;

    }



    
   
}