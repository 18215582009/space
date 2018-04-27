<?php
namespace Home\Controller;

header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
class IndexController extends HomeController {

    public function _initialize(){
        parent::_initialize();
        // 添加微信号,2016.07.26
     
    }
    public function LotterPool(){
        $this->display();
    }
    public function index(){
        $this->display();
    }

    public function goodslist(){
      $this->display();
    }

    public function map(){
      $this->display();
    }

    public function person(){
          //获取access_token
          $conf = C('WECHAT');
          $access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$conf['appid']."&secret=".$conf['appsecret'];
          $res = json_decode($this->httpGet($access_url));
          $access_token = $res->access_token;
          $userinfo = session('oauth_userinfo');
          $subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$userinfo['openid'];
          $subscribe = json_decode(file_get_contents($subscribe_msg));
          $gzxx = $subscribe->subscribe;
          if($gzxx === 1){
             $this->assign('is_flow',1);
          }else{
             $this->assign('is_flow',0);
          }
        $this->display();
    }

    public function shareList(){
        $this->display();
    }

    public function nocode(){
          $this->display();
    }

    public function feed(){
        $this->display();
    }
    public function checkcommand(){
        $id = I('shop_id');
        $lottery = I('lottery');
        $only_key = I('delkey');
       $result = M('lottery_base')->query("select lb.name,lb.content,lb.explain,l.start_time,l.end_time,lyf.only_key,
                    gy.title from
            lottery_base as lb 
                 join lottery  as l on lb.id = l.l_id
                 join lotteryf_role as lyf on  lyf.l_id = l.id 
                 join gy_document as gy on lb.shop_id=gy.id
                 where lyf.only_key='".$only_key."'");
       $res = Array();
        foreach ($result as $key => $value) {
            $res[$key]['name']=$value['name'];
            $res[$key]['content']=$value['content'];
            $res[$key]['explain']=$value['explain'];
            $res[$key]['start_time']=date("Y-m-d H:i:s",$value['start_time']);
            $res[$key]['end_time']=date("Y-m-d H:i:s",$value['end_time']);
            $res[$key]['only_key']=$value['only_key'];
            $res[$key]['title']=$value['title'];
        }
        $this->assign('res',$res); 
        $this->assign('shop_id',$id); 
        $this->assign('lottery',$lottery); 
        $this->display("check-command");
    }


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









}
