<?php
namespace Common\Model;
use Think\Model;
class MemberFollowModel extends Model{
    
    protected $_validate = array(
        array('member_id', 'require', '用户id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('follow_member_id', 'require', '关注用户id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    
        array(array('member_id', 'follow_member_id'), '', '已关注该用户', self::MUST_VALIDATE, 'unique', self::MODEL_INSERT),
    );
    
    protected $_auto = array(
        array('follow_ctime', NOW_TIME, self::MODEL_INSERT)
    );
    
    public function getFollowCount($member_id){
        $map['member_id'] = $member_id;
        
        return $this->where($map)->count();
    }
    
    public function getFansCount($member_id){
        $map['follow_member_id'] = $member_id;
        
        return $this->where($map)->count();
    }
    
    public function getMemberList($page, $member_id, $type = ''){
        $where = array();
        
        switch ($type){
            case 'follow':
                $where['member_id'] = $member_id;
                break;
            case 'fans':
                $where['follow_member_id'] = $member_id;
                break;
            default:
                $where['follow'] = 0;
                break;            
        }
        
        $follow_list = $this->page($page, C('HOME_PAGE_ROWS'))
                            ->where($where)
                            ->select();
        if(!$follow_list){
            return array();
        }
        
        $member_ids = array();
        
        switch ($type){
            case 'follow':
                foreach ($follow_list as $info){
                    $member_ids[] = $info['follow_member_id'];
                }
                break;
            case 'fans':
                foreach ($follow_list as $info){
                    $member_ids[] = $info['member_id'];
                }
                break;
            default:
                $member_ids[] = 0;
                break;
        }
        
        $where = array();
        $where['member_id'] = array('in', array_unique($member_ids));
        
        $member_model = D('Member');
        $member_list = $member_model->field('member_id, member_name, member_avatar')
                                    ->where($where)
                                    ->select();   
        
        return $member_list;
        
    }
}