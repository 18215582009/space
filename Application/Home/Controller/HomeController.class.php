<?php
namespace Home\Controller;
use Common\Controller\WechatController;
use Common\Controller\ErrorCodeController;

class HomeController extends CallbackController{
    
    public $mid;
    
    public function _initialize(){
         session('__forward__', $_SERVER['REQUEST_URI']);
     
        if(!is_oauth()){
            $callback = U('Callback/index', '', true, true);
            $state    = '';
            $scope    = 'snsapi_userinfo';
            $oauth_url = $this->tpWechat->getOauthRedirect($callback, $state, $scope);
            redirect($oauth_url);
        }
        if(!is_login()){//是否登录
            $userinfo = session('oauth_userinfo');
            $is_exists =  M('member')->query("select m.member_id from member as m left join member_wechat as mw on m.member_id = mw.member_id where  mw.openid = '".$userinfo['openid']." ' ");
            if(!empty($is_exists) and false!==$is_exists){//如果存在自动登录
                  // echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'0';exit;
                 $data = $this->wechatLogin($userinfo);
                 $this->mid = session('member_auth.mid');
                 if($data){
                    $this->success('',session('__forward__'));
                 }
            }else{//自动注册
                $upload = array('url'=>$userinfo['headimgurl'],'ext'=>'webp','location'=>'wechat','ctime'=>NOW_TIME,'utime'=>NOW_TIME,'status'=>STATUS_RESUME);
                $upload_id = M('PublicUpload')->add($upload);
                if(!$upload_id || false==$upload_id){
                    M('PublicUpload')->delete($upload_id);
                    $result = array('code'=>ErrorCodeController::USERINFO_UPLOAD_FAILD,'data'=>null,'info'=>'个人信息上传失败');
                    echo json_encode($result);exit;
                }
                $member = array('member_name'=>$this->jsonName($userinfo['nickname']),'member_gender'=>$userinfo['sex'],'member_avatar'=>$upload_id,'member_status'=>STATUS_RESUME,'member_last_login_ip'=> get_client_ip(1),'member_last_login_time'=>NOW_TIME,'member_login_num'=>array('exp', '`member_login_num`+1'),'member_password'=>123,'feed_count'=>0);
                $member_id = M('Member')->add($member);
                if(!$member_id || false== $member_id){
                     M('PublicUpload')->delete($upload_id);
                     $result = array('code'=>ErrorCodeController::REGISTER_FAILD,'data'=>null,'info'=>'自动注册失败');
                     echo json_encode($result);exit;
                }
                $userinfo['member_id'] = $member_id;
                $userinfo['nickname']= $this->jsonName( $userinfo['nickname']);
                $memberWechat = M('member_wechat')->add($userinfo);
                if(!$memberWechat || false==$memberWechat){
                    M('PublicUpload')->delete($upload_id);
                    M('Member')->delete($member_id);
                    $result = array('code'=>ErrorCodeController::WECHAT_REGISTER_FAILD,'data'=>null,'info'=>'自动注册微信失败');
                    echo json_encode($result);exit; 
                }
                 $data = $this->wechatLogin($userinfo);
                 $this->mid = session('member_auth.mid');
                 if($data){
                     $this->success('',session('__forward__')); 
                 }

            }

        }
        
       
    }




    /**
     * 微信号登录
     * @param array $userinfo
     */
    public function wechatLogin($userinfo,  $isAdmin = false,$where = array()){

        if(empty($userinfo) || !is_array($userinfo)){
            $this->error = '错误的授权信息';
            return false;
        }
        $where['openid'] = $userinfo['openid'];
        $memberWecaht_info =M('MemberWechat')->where($where)->find();
        if(!$memberWecaht_info){
            $this->error = '登录失败,该微信号未绑定';
            return false;
        }

        $where = array();
        $where['member_id'] = $memberWecaht_info['member_id'];
        $where['member_status'] = array('eq', STATUS_RESUME);
        $member_info = M('member')->where($where)->find();

        if(!$member_info){
            $this->error = '登录失败,用户不存在或被禁用';
            return false;
        }

        if($isAdmin){
            if($member_info['group_id'] == 0){
                $this->error = '权限不足';
                return false;
            } 
        }
    
        // 更新登录信息
        $data = array(
            'member_id'              => $member_info['member_id'],
            'member_login_num'       => array('exp', '`member_login_num`+1'),
            'member_last_login_time' => NOW_TIME,
            'member_last_login_ip'   => get_client_ip(1),
        );

        M('member')->save($data);
         // 记录登录SESSION和COOKIES
        $auth = array(
            'mid'              => $member_info['member_id'],
            'name'             => $member_info['member_name'],
            'avatar'           => $member_info['member_avatar'],
            'last_login_time'  => $member_info['member_last_login_time'],
            'last_login_ip'    => $member_info['member_last_login_ip'], 
        );
        session('member_auth',null);
        session('member_auth', $auth);

        session('member_auth_sign', $this->dataAuthSign($auth));

        return $member_info['member_id'];              
    }


     /**
     * 检验是否登录
     * @param array $userinfo
     */
    

     public function isLogin(){
        $member = session('member_auth') ? : cookie('member_auth');
        $member_auth_sign = session('member_auth_sign') ? : cookie('member_auth_sign');
        if(empty($member)){
            return 0;
        }else{
            return $member_auth_sign == $this->dataAuthSign($member) ? $member['mid'] : 0;
        }
    }

    /**
     * 验证权限签名
     * @param array $userinfo
     */

    public function dataAuthSign($data){
        // 数据类型检测
        if(!is_array($data)){
            $data = (array)$data;
        }
        ksort($data);// 排序
        $code = http_build_query($data);// url编码并生成query字符串
        $sign = sha1($code);// 生成签名
        return $sign;    
    }


   public  function jsonName($str) {
    if($str){
        $tmpStr = json_encode($str);
        $tmpStr2 = preg_replace("#(\\\ud[0-9a-f]{3})#ie","",$tmpStr);
        $return = json_decode($tmpStr2);
        if(!$return){
            return jsonName($return);
        }
    }else{
        $return = 'wixin-'.time();
    }    
    return $return;
}


    




}