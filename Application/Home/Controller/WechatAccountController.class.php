<?php
namespace Home\Controller;

class WechatAccountController extends HomeController {
    
    public function edit(){
        
        if(IS_POST){
            $member_wechat_account = I('member_wechat_account');
            
            if(!$member_wechat_account){
                $this->error('请输入微信号');
            }
            
            $member_model = D('Member');
            $member_model->member_id             = $this->mid;
            $member_model->member_wechat_account = $member_wechat_account;
            
            $result = $member_model->save();
            if($result !== false){
                $this->success('添加成功', U('Index/index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $where = array();
            $where['member_id'] = $this->mid;
            $member_model = D('Member');
            $this->member_wechat_account = $member_model->where($where)->getField('member_wechat_account');
            $this->meta_title = '微信号';
            $this->display();
        }
    }
    
    public function cancel(){
        S('member_wechat_account_'.$this->mid, 1);
        
        $this->redirect('Index/index');
    }
}