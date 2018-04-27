<?php
namespace Common\Model;
use Think\Model;
class FeedFavoriteModel extends Model{

    protected $_validate = array(
        array('feed_id', 'require', '分享id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('member_id', 'require', '用户id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    
        array(array('feed_id', 'member_id'), '', '已收藏', self::MUST_VALIDATE, 'unique', self::MODEL_INSERT),
    );
    
    protected $_auto = array(
        array('favorite_ctime', NOW_TIME, self::MODEL_INSERT)
    );    
    
    public function getFavCount($map){
        return $this->where($map)->count();
    }
}
