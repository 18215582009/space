<?php
namespace Wap\Controller;
use Common\Controller\WechatController;
class WapController extends WechatController {
    
    public function _initialize(){
        session('__forward__', $_SERVER['REQUEST_URI']);
        
        if(is_wechatBrowser()){
            if(!is_oauth()){
                $callback = U('Callback/index', '', true, true);
                $state    = '';
                $scope    = 'snsapi_userinfo';
                
                $oauth_url = $this->tpWechat->getOauthRedirect($callback, $state, $scope);
                redirect($oauth_url);                
            }
            
            if(!is_login()){
                $member_model = D('Member');
                $member_id = $member_model->wechatLogin(session('oauth_userinfo'), true);
                
                if(!$member_id){
                    $this->error($member_model->getError(), U('Account/login'));
                }    
            }
            
        }else{
            if(!is_login()){
                $this->redirect('Account/login');
            }
        }
        
        $this->mid = session('member_auth.mid');
    }
}