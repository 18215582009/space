<?php
namespace Common\Model;
use Think\Model;
class FeedCommentModel extends Model{
    
    protected $_validate = array(
        array('feed_id', 'require', '分享id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('member_id', 'require', '用户id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('comment_content', 'require', '评论不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    );
    
    protected $_auto = array(
        array('comment_ctime', NOW_TIME, self::MODEL_INSERT)
    );
    
    protected function _before_insert(&$data, $options){
        $data['comment_content'] = json_encode($data['comment_content']);
    }
    
    protected function _after_find(&$result, $options){
        $result['comment_content'] = json_decode($result['comment_content']);
    }
    
    protected function _after_select(&$resultSet, $options){
        foreach ($resultSet as &$record){
            $this->_after_find($record, $options);
        }
    }
    
    public function getList($page, $where = array()){
        
        $comment_list = $this->where($where)
                             ->page($page, C('HOME_PAGE_ROWS'))
                             ->select();
        
        if(!$comment_list){
            return array();
        }
        
        $member_ids = array();
        $reply_comment_ids = array();
        
        foreach ($comment_list as $info){
            $member_ids[] = $info['member_id'];
            $reply_comment_ids[] = $info['reply_comment_id'];
        }
        
        $where = array();
        $where['member_id'] = array('in', array_unique($member_ids));
        
        $member_model = D('Member');
        $member_list = $member_model->where($where)
                                    ->getField('member_id, member_name, member_avatar');
        
        foreach ($member_list as &$info){
            $info['member_avatar'] = get_cover($info['member_avatar'], 'avatar');
            $info['url_info'] = U('Member/info', array('member_id'=>$info['member_id']));
        }
        
        $where = array();
        $where['comment_id'] = array('in', array_unique($reply_comment_ids));
        
        $reply_comment_list = $this->where($where)
                                   ->getField('comment_id, member_id'); 
        
        foreach ($comment_list as &$info){
            $info['member'] = $member_list[$info['member_id']];
            $info['comment_ctime'] = friendly_date($info['comment_ctime'], 'mohu');
            $info['reply_url'] = U('feed/comment', array('feed_id'=>$info['feed_id'] , 'reply_comment_id'=>$info['comment_id']));
            $info['reply_member'] = $member_list[$reply_comment_list[$info['reply_comment_id']]];
        }       

        return $comment_list;
    }
    
    public function getCommentCount($where = array()){
        return $this->where($where)->count();
    }
}
