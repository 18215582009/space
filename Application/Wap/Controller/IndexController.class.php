<?php
namespace Wap\Controller;
class IndexController extends WapController {
    public function index(){
        $this->redirect('Index/pending');
    }
    
    public function pending($p = 1){
        $member_id = $this->member_id;
        
        $where = array();
        $where['feed_status'] = STATUS_FORBID;
        
        $feed_model = D('Feed');
        $feed_list = $feed_model->getList($p, $member_id, $where);
        
        $page = new \Common\Util\Page($feed_model->where($where)->count(), C('HOME_PAGE_ROWS'));
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%UP_PAGE% %DOWN_PAGE%');
        
        $this->assign('data_page', $page->show());
        $this->assign('feed_list', $feed_list);
        $this->assign('menu', STATUS_FORBID);
        $this->assign('meta_title', '审核列表');
        $this->display();
    }
    
    public function auditPass($feed_id){
        $data = array();
        $data['feed_id']     = $feed_id;
        $data['feed_status'] = STATUS_RESUME;
        
        $feed_model = D('Feed');
        $result = $feed_model->save($data);
        if($result !== false){
            //
            $feed_info = $feed_model->find($feed_id);
            
            $memberWechat = D('MemberWechat');
            $wechat_info = $memberWechat->where(['member_id'=>$feed_info['member_id']])->find();
            
            $messageData = C('WECHAT.audit')['success'];
            $messageData['touser'] = $wechat_info['openid'];
            
            send_template_message($messageData);
            
            $this->success('审核成功', U('Index/pending'));
        }else{
            $this->error('审核失败');
        }
    }
    
    public function auditNoPass($feed_id){
        $data = array();
        $data['feed_id']     = $feed_id;
        $data['feed_status'] = STATUS_HIDE;
        
        $feed_model = D('Feed');
        $result = $feed_model->save($data);
        if($result !== false){
            $feed_info = $feed_model->find($feed_id);
            
            $memberWechat = D('MemberWechat');
            $wechat_info = $memberWechat->where(['member_id'=>$feed_info['member_id']])->find();
            
            $messageData = C('WECHAT.audit')['error'];
            $messageData['touser'] = $wechat_info['openid'];
            
            send_template_message($messageData);
            
            $this->success('操作成功', U('Index/pending'));        
        }else{
            $this->error('操作失败');
        }
    }
    
    public function hasPass($p = 1){
        $member_id = $this->member_id;
        
        $where = array();
        $where['feed_status'] = STATUS_RESUME;
        
        $feed_model = D('Feed');
        $feed_list = $feed_model->getList($p, $member_id, $where);

        $page = new \Common\Util\Page($feed_model->where($where)->count(), C('HOME_PAGE_ROWS'));
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%UP_PAGE% %DOWN_PAGE%');
        
        $this->assign('data_page', $page->show());        
        $this->assign('feed_list', $feed_list);
        $this->assign('menu', STATUS_RESUME);
        $this->assign('meta_title', '全部列表');
        $this->display();        
    } 
    
    public function noPass($p = 1){
        $member_id = $this->member_id;
    
        $where = array();
        $where['feed_status'] = STATUS_HIDE;
    
        $feed_model = D('Feed');
        $feed_list = $feed_model->getList($p, $member_id, $where);
    
        $page = new \Common\Util\Page($feed_model->where($where)->count(), C('HOME_PAGE_ROWS'));
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%UP_PAGE% %DOWN_PAGE%');
    
        $this->assign('data_page', $page->show());
        $this->assign('feed_list', $feed_list);
        $this->assign('menu', STATUS_HIDE);
        $this->assign('meta_title', '屏蔽列表');
        $this->display();
    }    
    
    public function hide($feed_id){
        $data = array();
        $data['feed_id']     = $feed_id;
        $data['feed_status'] = STATUS_HIDE;
    
        $feed_model = D('Feed');
        $result = $feed_model->save($data);
        if($result !== false){
            $this->success('屏蔽成功', U('Index/hasPass'));
        }else{
            $this->error('屏蔽失败');
        }
    }
    
    public function show($feed_id){
        $data = array();
        $data['feed_id']     = $feed_id;
        $data['feed_status'] = STATUS_RESUME;
    
        $feed_model = D('Feed');
        $result = $feed_model->save($data);
        if($result !== false){
            $this->success('显示成功', U('Index/noPass'));
        }else{
            $this->error('显示失败');
        }
    }    
    
    public function delete($p = 1){
        $member_id = $this->member_id;
        
        $where = array();
        $where['feed_status'] = STATUS_RECYCLE;
        
        $feed_model = D('Feed');
        $feed_list = $feed_model->getList($p, $member_id, $where);

        $page = new \Common\Util\Page($feed_model->where($where)->count(), C('HOME_PAGE_ROWS'));
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('theme', '%UP_PAGE% %DOWN_PAGE%');
        
        $this->assign('data_page', $page->show());        
        $this->assign('feed_list', $feed_list);
        $this->assign('menu', 3);
        $this->assign('meta_title', '回收站');
        $this->display();        
    }
    
    public function doDelete($feed_id){
        $data = array();
        $data['feed_id']     = $feed_id;
        $data['feed_status'] = STATUS_RECYCLE;
        
        $feed_model = D('Feed');
        $result = $feed_model->save($data);
        if($result !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }       
    }
    
    public function doRestore($feed_id){
        $data = array();
        $data['feed_id']     = $feed_id;
        $data['feed_status'] = STATUS_RESUME;
        
        $feed_model = D('Feed');
        $result = $feed_model->save($data);
        if($result !== false){
            $this->success('还原成功');
        }else{
            $this->error('还原失败');
        }        
    }
}