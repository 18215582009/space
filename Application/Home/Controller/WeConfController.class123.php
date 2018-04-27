<?php
namespace Home\Controller;

use Common\Controller\ErrorCodeController;



header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
class WeConfController extends HomeController{
    /**
     * 获取微信配置信息--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  del
     * @param $feed_id   分享id
     * @param 
     */
    public function get_WeiConfig(){
    	if(IS_POST){
            $conf = C('WECHAT');
            $data = $this->getJsConfig();
            $temp = json_decode($data);
            $res = array();
            $res['appId'] = $temp->appId;
            $res['nonceStr'] = $temp->nonceStr;
            $res['timestamp'] = $temp->timestamp;
            $res['url'] = $temp->url;
            $res['signature'] = $temp->signature;
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$res,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>$info,'info'=>'请求出错');
            echo json_encode($result);exit;
        }
    }



     /**
     * 判断距离数据操作--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  get_Distance
     * @param 
     * @param 
     */
    public function get_Distance(){
        if(IS_POST){
            $lat1 = 31.4392900000; //126纬度
            $lng1 = 104.7569500000;//经度
            if(isset($_POST['shop_id']) and $_POST['shop_id']!==""){//商家id
                $shop_id = $_POST['shop_id'];
            }else{
                 $result = array('code'=>LNG_NOT_NULL::SHOP_ID_NOT_NULL,'data'=>null,'info'=>'商户id不能为空');
                 echo json_encode($result);exit;
            }
            if(isset($_POST['longitude']) and $_POST['longitude']!==""){//获取经度
                $longitude = $_POST['longitude'];
            }else{
                 $result = array('code'=>LNG_NOT_NULL::REQUEST_ERROR,'data'=>null,'info'=>'经度不能为空');
                 echo json_encode($result);exit;
            }
             if(isset($_POST['latitude']) and $_POST['latitude']!==""){//获取纬度
                $latitude = $_POST['latitude'];
            }else{
                 $result = array('code'=>LNG_NOT_NULL::LAT_NOT_NULL,'data'=>null,'info'=>'纬度不能为空');
                 echo json_encode($result);exit;
            }
            $distance = $this->distance($lat1,$lng1,$latitude,$longitude);//获取距离
            if($distance >= 0 and $distance <= 0.5 ){
                $where['id'] = $shop_id;
                $data  = M('gy_document')
                       ->field('title,id')
                       ->where($where)
                       ->find();
              $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success');
               echo json_encode($result);exit;
            }else{
               $result = array('code'=>ErrorCodeController::NOT_IN_REGION,'data'=>null,'info'=>'不在区域内,无法发送');
               echo json_encode($result);exit;
            }
        }else{
             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求出错');
             echo json_encode($result);exit;
        }
    }




     /**
     * 计算坐标距离--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  distance
     * @param 
     * @param 
     */

     public function distance($lat1, $lng1, $lat2, $lng2, $miles = true){
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat/2)*sin($dlat/2)+cos($lat1)*cos($lat2)*sin($dlng/2)*sin($dlng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
        return ($miles ? ($km * 0.621371192) : $km);
    }





    
   
}