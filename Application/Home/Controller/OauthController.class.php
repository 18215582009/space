<?php
namespace Home\Controller;
use Think\Controller;

class OauthController extends Controller{
    
    /**
     * 绑定微信号
     */
    public function reg(){
        if(IS_POST){
            $userinfo = session('oauth_userinfo');
            
            $where = array();
            $where['openid'] = $userinfo['openid'];
            
            $memberWechat_model = D('MemberWechat');
            $memberWechat_info = $memberWechat_model->where($where)->find();
            if($memberWechat_info){
                $this->error('该微信号,已绑定用户');
            }
            
            $upload = array();
            $upload['url']      = $userinfo['headimgurl'];
            $upload['ext']      = 'webp';
            $upload['location'] = 'wechat';
            $upload['ctime']    = NOW_TIME;
            $upload['utime']    = NOW_TIME;
            $upload['status']   = STATUS_RESUME;
            
            $upload_model = D('PublicUpload');
            $upload_id = $upload_model->add($upload);
            
            if(!$upload_id){
                $this->error('保存微信头像失败');
            }
            
            $member = array();
            $member['member_name']   = I('post.member_name');
            $member['member_gender'] = $userinfo['sex'];
            $member['member_avatar'] = $upload_id;
            
            $member_model = D('Member');
            $data = $member_model->create($member, 7);
            if(!$data){
                $upload_model->delete($upload_id);
                $this->error($member_model->getError());
            }
            
            $member_id = $member_model->add();
            if(!$member_id){
                $upload_model->delete($upload_id);
                $this->error('自动注册账号失败');
            }
            
            $userinfo['member_id'] = $member_id;
            
            if(!$memberWechat_model->add($userinfo)){
                $upload_model->delete($upload_id);
                $member_model->delete($member_id);
                $this->error('绑定微信用户失败');
            }
            
            $member_model->wechatLogin($userinfo);
            $this->success('绑定成功', U('Index/index'));
            
        }else{
            
            //print_r(222);exit;
            $this->assign('meta_title', '绑定微信号');
            $this->fetch("Oauth/reg");
        }
    }
}