<?php
namespace Wap\Controller;
use Common\Controller\WechatController;

class CallbackController extends WechatController{

    public function index(){
        $access_arr = $this->tpWechat->getOauthAccessToken();
        $userinfo   = $this->tpWechat->getOauthUserinfo($access_arr['access_token'], $access_arr['openid']);
        
        if($userinfo){
            session('oauth_userinfo', $userinfo);
            
            $url = session('__forward__') ? : U('Index/index', '', true, true);
            redirect($url);
        }else{
            session(null);
            cookie(null);
            
            $this->error($this->tpWechat->errMsg);
        }
    }
}