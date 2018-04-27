<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台公共控制器
 */
class PublicController extends Controller{
    /**
     * 后台登陆
     */
    public function login(){
        if(IS_POST){
            $username = I('username');
            $password = I('password');
            
            //图片验证码校验
//             if(!$this->check_verify(I('post.verify'))){
//                 $this->error('验证码输入错误！');
//             }            
            
            $map = array();
            $map['group_id'] = array('GT', 0); // 权限用户才可登录后台 TODO
            
            $member_model = D('Member');
            $member_id = $member_model->login($username, $password, $map);
            if($member_id){
                $this->success('登录成功', U('Index/index'));
            }else{
                $this->error($member_model->getError());
            }
        }else{
            if(D('Member')->isLogin()){
                $this->redirect('Index/index');
            }
            
            $this->assign('meta_title', '后台登录');
            $this->display();
        }
    }

    /**
     * 注销
     * @author jry <598821125@qq.com>
     */
    public function logout(){
        session('member_auth', null);
        session('member_auth_sign', null);
        cookie('member_auth', null);
        cookie('member_auth_sign', null);
        $this->success('退出成功！', U('Public/login'));
    }

    /**
     * 图片验证码生成，用于登录和注册
     * @author jry <598821125@qq.com>
     */
    public function verify($vid = 1){
        $verify = new \Think\Verify();
        $verify->length = 4;
        $verify->entry($vid);
    }
    
    /**
     * 检测验证码
     * @param  integer $id 验证码ID
     * @return boolean 检测结果
     */
    function check_verify($code, $vid = 1){
        $verify = new \Think\Verify();
        return $verify->check($code, $vid);
    }
}
