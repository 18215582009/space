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
            if(isset($_POST['url']) and $_POST!==""){
                $url = $_POST['url'];
            }else{
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            }
           $conf = C('WECHAT');
           $access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$conf['appid']."&secret=".$conf['appsecret'];
           $res = json_decode($this->httpGet($access_url));
           $access_token = $res->access_token;
           $ticket_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
           $jstiket = json_decode($this->httpGet($ticket_url)); 
           $jsapiTicket = $jstiket->ticket;
           // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
           // $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $timestamp = time();
            $nonceStr = $this->createNonceStr();
            // 这里参数的顺序要按照 key 值 ASCII 码升序排序
            $string = "jsapi_ticket=".$jsapiTicket."&noncestr=".$nonceStr."&timestamp=".$timestamp."&url=".$url;
            $signature = sha1($string);
            $signPackage = array(
              "appId"     => $conf['appid'],
              "nonceStr"  => $nonceStr,
              "timestamp" => $timestamp,
              "url"       => $url,
              "signature" => $signature,
              "rawString" => $string,
              "jsapiTicket"=> $jsapiTicket
            );
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$signPackage,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>$info,'info'=>'请求出错');
            echo json_encode($result);exit;
        }
    }


    public function getCurrentUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
            || $_SERVER['SERVER_PORT'] === 443) ? 'https://' : 'http://';
         
        return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];        
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
    // public function get_Distance(){
    //     if(IS_POST){
    //         if(isset($_POST['shop_id']) and $_POST['shop_id']!==""){//商家id
    //             $shop_id = $_POST['shop_id'];
    //         }else{
    //              $result = array('code'=>ErrorCodeController::SHOP_ID_NOT_NULL,'data'=>null,'info'=>'商户id不能为空');
    //              echo json_encode($result);exit;
    //         }
    //         $where['id'] = $shop_id;
    //         $data  = M('gy_document')
    //                    ->field('title,id')
    //                    ->where($where)
    //                    ->find();
    //         $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success');
    //         echo json_encode($result);exit;

    //     }else{
    //          $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求出错');
    //          echo json_encode($result);exit;
    //     }
    // }




 private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }


  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

    public function decodeurl(){
        $url = isset($_POST['title'])?$_POST['title']:"";
        $title = urldecode($url);
        $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$title,'info'=>'解密成功');
        echo json_encode($result);exit;
        
    }




    
   
}