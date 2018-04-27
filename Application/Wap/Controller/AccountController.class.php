<?php
namespace Wap\Controller;
use Think\Controller;
class AccountController extends Controller{
    
    public function login(){
        if(IS_POST){
            if(!$this->checkVerify(I('verify'))){
                $this->error('验证码错误');
            }
            
            $where = array();
            $map['group_id'] = array('GT', 0); // 权限用户才可登录后台 TODO
            
            $member_model = D('Member');
            $member_id = $member_model->login(I('username'), I('password'), $where);
            
            if($member_id){
                $this->success('登录成功', U('Index/index')); 
            }else{
                $this->error($member_model->getError());
            }
            
        }else{
            
            $this->assign('meta_title', '管理员登录');
            $this->display();
        }
    }
    
    public function verify($id = 1){
        $Verify = new \Think\Verify();
        // 设置验证码字符为纯数字
        $Verify->codeSet = '0123456789';
        $Verify->length  = 4;
        $Verify->entry($id);
    }
    
    public function checkVerify($code, $id = 1){    
        $verify = new \Think\Verify();    
        return $verify->check($code, $id);
    }
}