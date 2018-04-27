<?php
namespace Home\Controller;
class CommentController extends HomeController{
    
    public function page(){
        $page    = I('page', 1, 'intval');
        $feed_id = I('feed_id', 0, 'intval');
        
        $where = array();
        $where['feed_id'] = $feed_id;
        
        $comment_model = D('FeedComment');
        $comment_list = $comment_model->getList($page, $where);
        
        $this->ajaxReturn(array('comment_list'=>$comment_list, 'member_id'=>$this->mid));
    }
}