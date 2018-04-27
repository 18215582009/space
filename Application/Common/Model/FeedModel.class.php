<?php
namespace Common\Model;
use Think\Model;

class FeedModel extends Model{
    
    protected function _before_insert(&$data, $options){
        $data['feed_content'] = json_encode($data['feed_content']);
    }
    
    protected function _after_find(&$result, $options){
        $result['feed_content'] = json_decode($result['feed_content']);
    }
    
    protected function _after_select(&$resultSet, $options){
        foreach ($resultSet as &$result){
            $this->_after_find($result, $options);
        }
    }
    
    public function getRepostCount($map){
        return $this->where($map)->count();
    }
    
    public function getCommentCount($map){
        return M('FeedComment')->where($map)->count();
    }
    
    public function getFavCount($map){
        return M('FeedFavorite')->where($map)->count();
    }
    
    public function getInfo($feed_id, $member_id,$map = array(),$page_size){
        // 基本
        $where = array();
        $where['feed_id'] = $feed_id;
        $where['feed_status'] = STATUS_RESUME;
        
        $where = array_merge($where, $map);
        
        $feed_info = $this->where($where)->find();
        if(empty($feed_info)){
            return array();
        }


        
        // 图片
        $where = array();
        $where['feed_id'] = $feed_id;
        
        $feedData_model = D('FeedData');
        $feedData_list = $feedData_model->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                                        ->where($where)
                                        ->group('feed_id')
                                        ->select();
        
        $pics_url = array();
        foreach ($feedData_list as $info){
            $pics_url[$info['feed_id']] = get_covers($info['cover_ids']);
        }
        
        // 用户
        $where = array();
        $where['member_id'] = $feed_info['member_id'];
        
        $member_model = D('member');
        $member_info = $member_model->field('member_id, member_name, member_avatar, member_wechat_account')
                                    ->where($where)
                                    ->find();
        
        $member_info['member_avatar'] = get_cover($member_info['member_avatar'], 'avatar');
        $member_info['info_url']      = U('Member/info', array('member_id'=>$member_info['member_id']));
        
        // 友好时间
        $feed_info['feed_ctime']    = friendly_date($feed_info['feed_ctime'], 'mohu');
        // 图集
        $feed_info['cover_url']     = current($pics_url[$feed_info['feed_id']]) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
        $feed_info['pics_url']      = implode(',', $pics_url[$feed_info['feed_id']]); // 所有
        $feed_info['pics_count']    = count($pics_url[$feed_info['feed_id']]);
        // 收藏,评论,转发
        $feed_info['fav_count']     = $this->getFavCount(array('feed_id' => $feed_info['feed_id']));
        $feed_info['comment_count'] = $this->getCommentCount(array('feed_id' => $feed_info['feed_id']));
        $feed_info['repost_count']  = $this->getRepostCount(array('repost_feed_id' => $feed_info['feed_id']));
        //
        $feed_info['is_fav'] = is_fav($member_id, $feed_info['feed_id']);
        //
        $feed_info['is_self'] = is_self($member_id, $feed_info['member_id']) ? 1 : 0;
        //
        $feed_info['is_follow'] = is_follow($member_id, $feed_info['member_id']);
        // 用户        
        $feed_info['member'] = $member_info;
        //
        $feed_info['info_url']   = U('Feed/info', array('feed_id'=>$feed_info['feed_id']));
        $feed_info['repost_url'] = U('Feed/repost', array('feed_id'=>$feed_info['feed_id']));
        // 是否转发
        if($feed_info['repost_feed_id']){
            $feed_info['retweeted'] = $this->getInfo($feed_info['repost_feed_id'], $member_id);
        }
         $feed_info['fav_list'] = M('feed_favorite')
                                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account')
                                                ->alias('fa')
                                                ->join("left join member m on m.member_id = fa.member_id")
                                                ->where('fa.feed_id = '.$feed_info['feed_id'])
                                                ->order("fa.favorite_id desc")
                                                ->select();
        $c_where = array('fc.feed_id'=>$feed_info['feed_id']);
        $count      = M('feed_comment')
                    ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                    ->alias("fc")
                    ->join('left join member m on fc.member_id = m.member_id')
                    ->where($c_where)
                    ->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($c_where as $key=>$val) {    //分页跳转的时候保证查询条件
                $Page->parameter[$key]   =   urlencode($val);
        }
        $comment  = M('feed_comment')
                    ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                    ->alias("fc")
                    ->join('left join member m on fc.member_id = m.member_id')
                    ->where($c_where)
                    ->order("fc.comment_ctime desc")
                    ->page($page_size.',10')
                    ->select();
                    $arr = array();
                        // 循环获取评论信息
                    foreach ($comment as $k => $v) {
                        if($v['reply_comment_id'] !== 0 && $v['reply_comment_id']!=="0"){
                            $arr[$k] = M('feed_comment')
                                    ->field('fc.comment_id,fc.member_id,fc.comment_content,fc.comment_type,fc.reply_comment_id,fc.comment_ctime,m.member_name,m.member_wechat_account')
                                    ->alias('fc')
                                    ->join('left join member m on fc.member_id = m.member_id')
                                    ->where("fc.comment_id=".$v['reply_comment_id']." and ".$v['reply_comment_id']." <> 0 ")
                                    ->limit(2)
                                    ->order("fc.comment_ctime desc")
                                    ->find();
                        $arr[$k]['rc_id']= $v['comment_id']; 
                        $arr[$k]['mid']= $v['member_id'];  
                        $arr[$k]['contents']= $v['comment_content'];
                        $arr[$k]['comment_type']= $v['comment_type']; 
                        $arr[$k]['r_name']= $v['member_name']; 
                        $arr[$k]['rw_name']= $v['member_wechat_account']; 
                        $arr[$k]['rc_time']= $v['comment_ctime']; 
                    }       
        }


        isset($arr)?$arr:"";
        $feed_info['comment'] = array_merge($comment,$arr);//最后评论格式  合并 评论和回复评论的人
        foreach ($feed_info['comment'] as $i => $j) {
            $arr = array_map(create_function('$j', 'return $j["comment_ctime"];'), $feed_info['comment']);//返回comment_ctime排序规则
        }
        array_multisort($arr,SORT_ASC,$feed_info['comment'] );//多维数组的排序
    
        return $feed_info;
    }
    
    public function getList($p, $member_id, $map = array()){
        // 基本
        $where = array();
        $where['feed_status'] = STATUS_RESUME;
        
        $where = array_merge($where, $map);
        
        $feed_list = $this->page($p, C('HOME_PAGE_ROWS'))
                          ->where($where)
                          ->order('feed_utime desc, feed_ctime desc')
                          ->select();
        
        if(empty($feed_list)){
            return array();
        }
        
        $feed_ids   = array();
        $member_ids = array();
        foreach ($feed_list as $data){
            $feed_ids[]   = $data['feed_id'];
            $member_ids[] = $data['member_id'];
        }
        
        // 图片
        $where = array();
        $where['feed_id'] = array('in', array_unique($feed_ids));
        
        $feed_data_model = D('FeedData');
        $feed_data_list = $feed_data_model->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                                          ->where($where)
                                          ->group('feed_id')
                                          ->select();
        
        $pics_url = array();
        foreach ($feed_data_list as $data){
            $pics_url[$data['feed_id']] = get_covers($data['cover_ids']);
        }
        
        // 用户
        $where = array();
        $where['member_id'] = array('in', array_unique($member_ids));
        
        $member_model = D('member');
        $member_list = $member_model->where($where)->getField('member_id, member_name, member_avatar, member_wechat_account');
        
        foreach ($member_list as &$data){
            $data['member_avatar'] = get_cover($data['member_avatar'], 'avatar');
            $data['info_url']      = U('Member/info', array('member_id'=>$data['member_id']));
        }
        
        // 输出数据
        foreach ($feed_list as &$data){
            // 友好时间
            $data['feed_ctime']    = friendly_date($data['feed_ctime'], 'mohu');
            // 图集
            $data['cover_url']     = current($pics_url[$data['feed_id']]) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
            $data['pics_url']      = implode(',', $pics_url[$data['feed_id']]); // 所有
            $data['pics_count']    = count($pics_url[$data['feed_id']]);
            // 收藏,评论,转发
            $data['fav_count']     = $this->getFavCount(array('feed_id' => $data['feed_id']));
            $data['comment_count'] = $this->getCommentCount(array('feed_id' => $data['feed_id']));
            $data['repost_count']  = $this->getRepostCount(array('repost_feed_id' => $data['feed_id']));
            //
            $data['is_fav'] = is_fav($member_id, $data['feed_id']);    
            //
            $data['is_self'] = is_self($member_id, $data['member_id']) ? 1 : 0;       
            //
            $data['is_follow'] = is_follow($member_id, $data['member_id']);
            // 用户
            $data['member'] = $member_list[$data['member_id']];
            //
            $data['info_url']   = U('Feed/info', array('feed_id'=>$data['feed_id']));
            $data['repost_url'] = U('Feed/repost', array('feed_id'=>$data['feed_id']));
            
            
            // 是否是转发
            if($data['repost_feed_id']){
                // 转发TODO
                $data['retweeted'] = $this->getInfo($data['repost_feed_id'], $member_id);
            }
        }        
        
        return $feed_list;
    }
    
    public function getRepostContent($feed_id){
        $repost_content = '';
        
        $repost_info = $this->find($feed_id);
        $member_info = M('Member')->find($repost_info['member_id']);
        
        $repost_content .= "//@{$member_info['member_name']}:{$repost_info['feed_content']}";

        return $repost_content;
    }
}