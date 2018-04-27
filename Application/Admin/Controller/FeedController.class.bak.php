<?php
namespace Admin\Controller;
class FeedController extends  AdminController{
    


    /**
     * 获取分享列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  index
     * @param $p  分页数  $keyword 关键词  $sort 按排序条件搜索
     * @param 
     */

    public function index($p = 1){
        //搜索
        $keyword = I('keyword', '', 'string');
        $sort = I('sort', '', 'int');
        if($sort == 1){
            $order = "feed.feed_ctime desc";
        }else{
            $order = "feed.feed_ctime asc";
        }
        //搜素条件
        $condition = array('like', '%'.$keyword.'%');
        $where['feed.feed_id'] = array($condition,'_multi' => true);
        $where['feed_status'] = array('egt', STATUS_FORBID);
        $feed_model = D('feed');
        $feed_list = $feed_model->where($where)
                                ->join('left join member on feed.member_id = member.member_id')
                                ->page($p, C('ADMIN_PAGE_ROWS'))
                                ->order($order)
                                ->select();
        $data = array();
        //获取点赞
        $position_fav = M('feed_favorite')
                    ->field('feed_id,count(favorite_id)')
                    ->group('feed_id')
                    ->order('count(favorite_id) desc')
                    ->select();
        foreach ($position_fav as $key => $value) {
            $data[$key] = $value['feed_id'];
        }
        foreach ($feed_list as $key => $value) {
            //获取会员信息
            $member = M('member')
                    ->alias('m')
                    ->field('member_name')
                    ->where('member_id='.$value['member_id'])
                    ->find();
            //获取评论数量
            $comment = M('feed_favorite')
                    ->where('feed_id='.$value['feed_id'].' and comment_type = 0')
                    ->count();
            //获取点赞数量
            $favorite = M('feed_favorite')
                    ->where('feed_id ='.$value['feed_id'])
                    ->count();
            //获取点赞所在排名，
            $hot_position = array_search($value['feed_id'],$data);
            if($hot_position and  $hot_position!==""){
             $feed_list[$key]['fav'] =$hot_position;
            }else{
               $feed_list[$key]['fav'] =0;
            }
            $feed_list[$key]['member'] = $member['member_name'];
            $feed_list[$key]['comment'] = $comment;
            $feed_list[$key]['favorite'] = $favorite;
            $feed_list[$key]['feed_ctime'] = date('Y-m-d',$value['feed_ctime']);

        }
        //分页输出
        $page = new \Common\Util\Page($feed_model->where($where)->count(), C('ADMIN_PAGE_ROWS'));
        $this->assign('list',$feed_list);
        $this->assign('page',$page->show());
        $this->display();
    }


    public function details(){
        $id =I('id', '', 'int');
        $where['feed_id'] = $id;
        //获取会员信息
        $member = M('feed')
                ->alias('f')
                ->field('mw.headimgurl,mw.nickname')
                ->join('left join member_wechat mw on f.member_id = mw.member_id')
                ->where($where)
                ->find();
        //获取分享信息和图片
        $feed = M('feed')
              ->field('feed_ctime,feed_content,feed_title')
              ->where($where)
              ->find();
        $feed['feed_ctime'] = date('Y-m-d',$feed['feed_ctime']);
        //获取分享图片
        $picture = M('feed_data')
                ->field('cover_id')
                ->where($where)
                ->select();


        foreach ($picture as $key => $value) {
            $arr[]=$value['cover_id'];
        }
        $pic['id'] = array('in',array_unique($arr));

        $imgs = M('PublicUpload')
              ->field('id,path')
              ->where($pic)
              ->select();

        //评论数
        $comment_count = $this->get_CommentCount($where['feed_id']);
        //点赞数
        $fav_count = $this->get_fav($where['feed_id']);

        //获取全部评论信息
        $comment_info = M('FeedComment')
                       ->alias('fc')
                       ->field('fc.comment_id,fc.comment_ctime,fc.feed_id,fc.comment_content,fc.reply_comment_id,fc.comment_type,mw.nickname,mw.headimgurl')
                       ->join('left join member_wechat mw on fc.member_id = mw.member_id')
                       ->where($comment_where)
                       ->order('fc.comment_ctime desc')
                       ->select();
        //获取回复人的信息
        foreach ($comment_info as $key => $value){
            $comment_reply[$key]= $value;
            if($value['comment_type'] == 1 and $value['comment_type']!==0 and $value['reply_comment_id']!==0){
                $fcm = M('FeedComment')
                       ->alias('fc')
                       ->field('fc.member_id,m.nickname,fc.comment_content,fc.comment_ctime,m.headimgurl')
                       ->join('left join member_wechat m on fc.member_id = m.member_id')
                       ->where('fc.comment_id ='.$value['reply_comment_id'].' and fc.feed_id ='.$value['feed_id'])
                       ->order('fc.comment_ctime')
                       ->find();
                if($fcm and $fcm!==""){
                    $comment_reply[$key]['r_member_id'] = $fcm['member_id'];
                    $comment_reply[$key]['r_member_name'] = $fcm['nickname'];
                    $comment_reply[$key]['r_comment_content'] = $fcm['comment_content'];
                    $comment_reply[$key]['comment_ctime'] = $fcm['comment_ctime'];
                    $comment_reply[$key]['r_headimgurl'] = $fcm['headimgurl'];
                }
            }
        }
        //筛选出只有评论人的评论 去除评论内容的评论
        $reply_comment = array();
        foreach( $comment_reply as $key=>$value){
            if($value['r_member_id']){
                $reply_comment[$key]['comment_id'] = $value['comment_id'];
                $reply_comment[$key]['feed_id'] = $value['feed_id'];
                $reply_comment[$key]['comment_content'] = $value['comment_content'];
                $reply_comment[$key]['reply_comment_id'] = $value['reply_comment_id'];
                $reply_comment[$key]['comment_type'] = $value['comment_type'];
                $reply_comment[$key]['nickname'] = $value['nickname'];
                $reply_comment[$key]['headimgurl'] = $value['headimgurl'];
                $reply_comment[$key]['r_member_id'] = $value['r_member_id'];
                $reply_comment[$key]['r_member_name'] = $value['r_member_name'];
                $reply_comment[$key]['r_comment_content'] = $value['r_comment_content'];
                $reply_comment[$key]['comment_ctime'] = $value['comment_ctime'];
                $reply_comment[$key]['r_headimgurl'] = $value['r_headimgurl'];
            }
        }
        //获取评论过内容的人
        $comment_content = M("FeedComment")
                        ->alias('fc')
                        ->field('fc.comment_id,fc.feed_id,fc.comment_ctime,fc.comment_content,fc.reply_comment_id,fc.comment_type,mw.nickname,mw.headimgurl')
                        ->join('left join member_wechat mw on fc.member_id = mw.member_id')
                        ->where('fc.feed_id = '.$id.' and fc.reply_comment_id = 0  and fc.comment_type  = 0 ')
                        ->order('fc.comment_ctime desc')
                        ->select();

        $data = array_merge($comment_content,$reply_comment);//合并评论信息
        foreach ($data as $i => $j) {
            $arr = array_map(create_function('$j', 'return $j["comment_ctime"];'), $data);//返回comment_ctime排序规则
        }
        array_multisort($arr,SORT_DESC,$data );//多维数组的排序
        //end  合并信息并按时间顺序排序
        foreach ($data as $key =>$value){
                $result[$key]['comment_id'] = $value['comment_id'];
                $result[$key]['feed_id'] = $value['feed_id'];
                $result[$key]['comment_ctime'] = date('Y-m-d',$value['comment_ctime']);
                $result[$key]['comment_content'] = $value['comment_content'];
                $result[$key]['reply_comment_id'] = $value['reply_comment_id'];
                $result[$key]['comment_type'] = $value['comment_type'];
                $result[$key]['nickname'] = $value['nickname'];
                $result[$key]['headimgurl'] = $value['headimgurl'];
                if($value['r_member_id']){
                    $result[$key]['r_member_id'] = $value['r_member_id'];
                }
                if($value['r_member_name']){
                    $result[$key]['r_member_name'] = $value['r_member_name'];
                }
                if($value['r_comment_content']){
                    $result[$key]['r_comment_content'] = $value['r_comment_content'];
                }
                if($value['comment_ctime']){
                    $result[$key]['comment_ctime'] = date("Y-m-d",$value['comment_ctime']);
                }
                if( $value['r_headimgurl']){
                    $result[$key]['r_headimgurl'] = $value['r_headimgurl'];
                }
        }

        $this->assign('id',$id);
        $this->assign('comment_list',$result);
        $this->assign('fav_count',$fav_count);
        $this->assign('comment_count',$comment_count);
        $this->assign('imgs',$imgs);
        $this->assign('feed',$feed);
        $this->assign('member',$member);
        $this->display();

    }


    /**
     * 删除分享--by xiewen
     *
     * @var object
     * @access mysql
     * @fun  fel
     * @param $feed_id 分享id
     * @param
     */
    public  function  del(){
        $feed_id = I('id');
        $where['feed_id'] = $feed_id;
        if($feed_id){
          $del =   M('Feed')->where($where)->delete();
          if($del and false!==$del){
              $this->success('删除成功',U('Feed/index'));
          }else{
              $this->error('删除失败');
          }
        }else{
            $this->error('删除失败');
        }

    }


    /**
     * 获取点赞数量--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  get_fav
     * @param $feed_id 分享id
     * @param 
     */

    public function get_CommentCount($feed_id){
         $where['feed_id'] = $feed_id;
         $comment_count = M('FeedComment')
                        ->where($where)
                        ->count();
        return $comment_count;
    }

    /**
     * 获取点赞数量--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  get_fav
     * @param $feed_id 分享id
     * @param 
     */


    public function get_fav($feed_id){
          $where['feed_id'] = $feed_id;
          $favorite = M('FeedFavorite')
                    ->where($where)
                    ->count();
         return $favorite;
    }

    /**
     * 获取下一个分享--by xiewen
     *
     * @var object
     * @access mysql
     * @fun  get_Next
     * @param $feed_id 分享id
     * @param
     */
    public  function get_Next(){
        $id =  I('id');
        $max = M('Feed')->field('feed_id')->order('feed_id desc')->limit(1)->find();
        for ($i = ($id+1);$id<=$max; $i++){
            $where['feed_id'] = $i ;
            $res = M('Feed')->field('feed_id')->where($where)->find();
            if($res){
                $this->success('跳转到下一页',U('Feed/details?id='.$res['feed_id']));
                break;
            }
        }

    }


    /**
     * 获取上一个分享--by xiewen
     *
     * @var object
     * @access mysql
     * @fun  get_Prev
     * @param $feed_id 分享id
     * @param
     */
    public  function get_Prev(){
        $id =  I('id');
        $max = M('Feed')->field('feed_id')->order('feed_id desc')->limit(1)->find();
        for ($i = ($id-1);$id<=$max; $i--){
            $where['feed_id'] = $i ;
            $res = M('Feed')->field('feed_id')->where($where)->find();
            if($res){
                $this->success('跳转到上一页',U('Feed/details?id='.$res['feed_id']));
                break;
            }
        }

    }









}