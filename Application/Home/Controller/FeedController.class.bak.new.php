<?php
namespace Home\Controller;
use Org\Util\String;
use Common\Controller\ErrorCodeController;

header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 


class FeedController extends HomeController{
    

    /**
     * 获取分享列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  get_FeedList
     * @param $page  分页数  $member_id  会员id
     * @param 
     */

    public function get_FeedList(){
        if(IS_POST){
            if(isset($_POST['page']) and  $_POST['page']!=="" and  $_POST['page'] !==0){
                $page_size = $_POST['page'];
            }else{
                  $page_size = 1;
            }
            if(isset($_POST['member_id']) and $_POST['member_id']!==""){
                $member_id = $_POST['member_id'];
            }else{
                $member_id = session('member_auth.mid');

            }
            $where['member_id'] =  $member_id;
            $count      = M('feed')->where($where)->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
            foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                $Page->parameter[$key]   =   urlencode($val);
            }
            $feed_list = M('feed')
                        ->where($where)
                        ->order('feed_id desc')
                        ->page($page_size.',10')
                        ->select();
            foreach($feed_list as $key =>$value){
                $list = D('FeedData')
                   ->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                   ->where(array('feed_id'=>$value['feed_id']))
                   ->group('feed_id')
                   ->select();
                $num =  get_covers($list[0]['cover_ids']);
                $feed_list[$key]['cover_url'] =  current($num) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
                $feed_list[$key]['pics_url']      = $num; // 所有
                $feed_list[$key]['pics_count']    = count($num);
            }
            if($feed_list){
                $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$feed_list,'info'=>'success');
                echo json_encode($result);exit;
            }else{
                $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>[],'info'=>'没有分享列表哦');
                echo json_encode($result);exit;
            }
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求出错');
            echo json_encode($result);exit;
        }
    }
    /**
     * 分享列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  page
     * @param $page  分页数  $member_id  会员id
     * @param 
     */
    // public function page(){
    //     if(IS_POST){
    //         // $page = I('page', 1, 'intval');
    //         //$member_id = I('member_id', 0, 'intval');
    //         $page = $_POST['page'];
    //         $member_id =$_POST['member_id'];
    //         $this->mid = 1;
    //         $map = array();
    //         if($member_id && $member_id!==""){
    //             $map['member_id'] = $member_id;
    //         }else{
    //             $map['member_id'] = $this->mid ;
    //         }
    //         $map['is_repost'] = FEED_NOT_REPOST;
    //         $fav = I('fav');
    //         if($fav){
    //             $feed_ids = I('feed_ids');
    //             if($feed_ids){
    //                 $map['feed_id'] = array('in', array_unique($feed_ids));
    //             }else{
    //                 $this->ajaxReturn(array('feed_list' => array()));
    //             }
    //         }
    //         $feed_list = D('Feed')->getList($page, $this->mid, $map);
    //         if(!empty($feed_list)){
    //             $result = array('code'=>200,'data'=>$feed_list,'info'=>'success');
    //             echo json_encode($result);exit;
    //         }else{
    //              $result = array('code'=>404,'data'=>null,'info'=>'faild');
    //             echo json_encode($result);exit;
    //         }
    //     }else{
    //         $result = array('code'=>500,'data'=>null,'info'=>'faild');
    //         echo json_encode( $result);exit;
    //     }

    // }
    
    /**
     * 获取一条分享--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  info
     * @param $this->mid  会员id  $feed_id  分享id
     * @param 
     */
    public function info(){

        if(IS_POST){
             //获取page
            //获取分享id
            if(isset($_POST['id']) and $_POST['id']!==""){
                $feed_id = $_POST['id'];
            }else{
                $result = array('code'=> ErrorCodeController::FEED_ID_NOT_NULL,'data'=>null,'info'=>'分享id不能为空');
                echo json_encode($result);exit;
            }
            $where = array('feed_id'=> $feed_id);
            $feed_info  = M('feed')
                    ->where($where)
                    ->find();    
            $feedData_list =  M('FeedData')->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                                        ->where($where['feed_id'])
                                        ->group('feed_id')
                                        ->select();
            $pics_url = array();
            foreach ($feedData_list as $info){
                $pics_url[$info['feed_id']] = get_covers($info['cover_ids']);
            }
            $member_info = M('member')
                                ->alias('m')
                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account,mw.headimgurl')
                                ->join('left join member_wechat mw on m.member_id = mw.member_id')
                                ->where(array('m.member_id'=>$feed_info['member_id']))
                                ->find();
            $feed_info['cover_url']     = current($pics_url[$feed_info['feed_id']]) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
            $feed_info['pics_url']      = $pics_url[$feed_info['feed_id']]; // 所有
            $feed_info['pics_count']    = count($pics_url[$feed_info['feed_id']]);
            // 收藏,评论,转发
            $feed_info['fav_count']     = $this->getFavCount(array('feed_id' => $feed_info['feed_id']));
            $feed_info['comment_count'] = $this->getCommentCount(array('feed_id' => $feed_info['feed_id']));
            $feed_info['repost_count']  = $this->getRepostCount(array('repost_feed_id' => $feed_info['feed_id']));
            //
            $feed_info['is_fav'] = is_fav(session('member_auth.mid'), $feed_info['feed_id']);
            //
            $feed_info['is_self'] = is_self(session('member_auth.mid'),$feed_info['member_id']) ? true : false;
            //
            $feed_info['is_follow'] = is_follow(session('member_auth.mid'),$feed_info['member_id']);
            // 用户        
            $feed_info['member'] = $member_info;
            $feed_info['fav_list'] = M('feed_favorite')
                                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account')
                                                ->alias('fa')
                                                ->join("left join member m on m.member_id = fa.member_id")
                                                ->where('fa.feed_id = '.$where['feed_id'])
                                                ->order("fa.favorite_id ASC")
                                                ->select();
        $c_where = array('fc.feed_id'=>$where['feed_id']);
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

       $comment_info = M('feed_comment')
                       ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                       ->alias("fc")
                       ->join('left join member m on fc.member_id = m.member_id')
                       ->where("fc.feed_id =".$where['feed_id']." and fc.comment_type = 0" )
                       ->order("fc.comment_ctime ASC")
                       ->select();

        $comment  = M('feed_comment')
                    ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                    ->alias("fc")
                    ->join('left join member m on fc.member_id = m.member_id')
                    ->where($c_where)
                    ->order("fc.comment_ctime desc")
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
                                    ->order("fc.comment_ctime ASC")
                                    ->find();
                        $arr[$k]['rc_id']= $v['comment_id']; 
                        $arr[$k]['mid']= $v['member_id'];  
                        $arr[$k]['contents']= $v['comment_content'];
                        $arr[$k]['comment_type']= $v['comment_type']; 
                        $arr[$k]['r_name']= $v['member_name']; 
                        $arr[$k]['rw_name']= $v['member_wechat_account']; 
                        $arr[$k]['comment_ctime']= $v['comment_ctime']; 
                    }       
        }
        isset($arr)?$arr:"";
        $feed_info['comment'] = array_merge($comment_info,$arr);//最后评论格式  合并 评论和回复评论的人
        foreach ($feed_info['comment'] as $i => $j) {
            $arr = array_map(create_function('$j', 'return $j["comment_ctime"];'), $feed_info['comment']);//返回comment_ctime排序规则
        }
        array_multisort($arr,SORT_ASC,$feed_info['comment'] );//多维数组的排序
            
        if($feed_info){
            $result = array('code'=> ErrorCodeController::SUCCESS,'data'=>$feed_info,'info'=>'success');
            echo json_encode($result);exit;
        }else{
             $result = array('code'=> ErrorCodeController::SUCCESS,'data'=>[],'info'=>'success');
            echo json_encode($result);exit;
        }
        }else{
            $result = array('code'=>500,'data'=>null,'info'=>'faild');
            echo json_encode($result);exit;
        }
    }
    /**
     * 评论--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  comment
     * @param $reply_comment_id  回复评论的id  $feed_id  分享id $comment_content  评论内容
     * @param 
     */
    public function comment(){
        if(IS_POST){
            $comment_id = isset($_POST['comment_id'])?$_POST['comment_id']:0;
            $feed_id = isset($_POST['feed_id'])?$_POST['feed_id']:"";
            $comment_content = isset($_POST['comment_content'])?$_POST['comment_content']:'';
            $comment_type = intval(isset($_POST['comment_type'])?$_POST['comment_type']:0);
            $comment_model = M('FeedComment');
            $member_id =  session('member_auth.mid');
            if($comment_id){
                $where = array();
                $where['comment_id'] = $comment_id;
                $reply_member_id = $comment_model->where($where)->getField('member_id');
            }
            if($reply_member_id == $member_id){
                $result = array('code'=> ErrorCodeController::NOT_REPLY_SELF,'data'=>null,'info'=>'不能回复自己');
                echo json_encode($result);exit;
            } 
            if($comment_type == 0){//评论内容
                $where = array('feed_id'=>$feed_id,'comment_content'=>$comment_content,'member_id'=> $member_id,'reply_comment_id'=>0,'comment_ctime'=>NOW_TIME,'comment_type'=>$comment_type);
                     $comment_id = $comment_model->add($where);
                     if(!$comment_id || false== $comment_id){
                         $result = array('code'=>ErrorCodeController::COMMENT_FAILD,'data'=>null,'info'=>'评论失败');
                        echo json_encode($result);exit;
                     }
            }else{//评论用户

                $where =  array('feed_id' =>$feed_id,'comment_content'=>$comment_content,'member_id'=> $member_id,'reply_comment_id'=>$comment_id,'comment_ctime'=>NOW_TIME,'comment_type'=>$comment_type );
                $comment_id = $comment_model->add($where);
                     if(!$comment_id || false== $comment_id){
                         $result = array('code'=>ErrorCodeController::COMMENT_FAILD,'data'=>null,'info'=>'评论失败');
                        echo json_encode($result);exit;
                     }
            }
            $feed_model = D('Feed');
            $feed_model->where(['feed_id'=>$feed_id])->setField('feed_utime', NOW_TIME);
            //通知微博作者
            $where = array();
            $where['feed_id'] = $_POST['feed_id']; // I('feed_id', 0, 'intval');
            
            $feed_info = D('Feed')->where($where)->find();
            
            $message = '评论内容 : '.$comment_content;
            send_comment_message($feed_info['member_id'], $feed_info['feed_id'], $message);
            //通知回复的人
            $where = array();
            if($reply_comment_id){
                $where['comment_id'] = $reply_comment_id;
            }else{
                $where['comment_id'] = $comment_id;
            }
            $comment_info = D('FeedComment')->where($where)->find();
            if($comment_info['member_id'] != $feed_info['member_id']){
                $message = '回复内容 : '.$comment_content;
                send_comment_message($comment_info['member_id'], $feed_id, $message);
            }
            $member_name = M('member')
                        ->field('member_name,member_wechat_account')
                        ->where('member_id = '.$member_id)
                        ->find();
            $data = array('feed_id'=>$feed_id,'member_id'=>  $member_id,'member_name'=>$member_name['member_name'],'member_wechat_account'=>$member_name['member_wechat_account']);
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'faild');
            echo json_encode($result);exit;
        }
    }

      /**
     *  发布分享--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  post
     * @param $content  内容   $images  图片
     * @param 
     */

      public function post(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $member_id = session('member_auth.mid');
             if(isset($_POST['content']) and $_POST['content']!==""){
                $content = $_POST['content'];
             }else{
                $result = array('code'=>ErrorCodeController::CONTENTS_NOT_NULL,'data'=>null,'info'=>'CONTENTS_NOT_NULL');
                 echo json_encode($result);exit;
             }
             if(isset($_POST['images']) and !empty($_POST['images'])){
                $images = $_POST['images'];
             }else{
                $result = array('code'=>ErrorCodeController::UPLOAD_IMAGES_NOT_NULL,'data'=>null,'info'=>'faild');
                echo json_encode($result);exit;
             }
             if(isset($_POST['shop_id']) and $_POST['shop_id']!==""){
                $shop_id = $_POST['shop_id'];
             }else{
                $result = array('code'=>ErrorCodeController::SHOP_ID_NOT_NULL,'data'=>null,'info'=>'faild');
                echo json_encode($result);exit;
             }
             $cover = array();
             $title = M('gy_document')->field('title')->where('id = '.$shop_id)->find();
             if($title=="" or false==$title){
                $title = "暂无";
             }
            $feed_where['feed_content'] =  $content;
            $feed_where['member_id'] = $member_id;
            $feed_where['feed_ctime'] = NOW_TIME;
            $feed_where['feed_status'] = -1;
            $feed_where['shop_id'] = $shop_id;
            $feed_where['feed_title'] = $title['title'];
            $feed = M('feed')->add($feed_where);
            if(!$feed){
                $result = array('code'=>ErrorCodeController::PUBLISH_FEED_FAILD,'data'=>null,'info'=>'发布分享失败');
                echo json_encode($result);exit;
            }
             foreach ($images as $key => $value) {
                 $where['path'] = $value;
                 $where['url'] = $value;
                 $where['localtion'] = 'wechat';
                 $where['ctime'] = TIME_NOW;
                 $where['utime'] = TIME_NOW;
                 $where['sort'] = 0 ;
                 $where['status'] = 1;
                 $where['md5'] = md5($value);
                 $where['sha1'] = sha1($value);
                 $data = M('public_upload')->add($where);
                 $cover = M('feed_data')->add(array('feed_id'=>$feed,'cover_id'=>$data));
             }
             if($data and $feed and $cover ){
                    $member = array('member_id'=>$member_id,'feed_count'=>array('exp','`feed_count`+1'));
                    $res = M('member')->save($member);
                    $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$feed,'info'=>'发布成功');
                    echo json_encode($result);exit;
              }else{
                    $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>[],'info'=>'发布失败');
                    echo json_encode($result);exit;
             }
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'faild');
            echo json_encode($result);exit;
        }



      }

     /**
     *  转发--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  repost 
     * @param $feed_content 分享内容   $repost_feed_id  转发的分享id
     * @param 
     */
    public function repost($feed_id = 0){
        if(IS_POST){
            // $feed_content   = I('feed_content') ? : '转发';
            // $repost_feed_id = I('repost_feed_id', 0, 'intval');
            $feed_content = trim($_POST['feed_content'])?$_POST['feed_content']:"";
            if(isset($_POST['repost_feed_id'])){
                 $repost_feed_id  = $_POST['repost_feed_id'];
            }else{
                $result = array('code'=>ErrorCodeController::REPOST_ID_NOT_NULL,'data'=>null,'info'=>'转发的分享id未传入');
                echo json_encode($result);exit;
            }
            $feed_model = D('Feed');
            $repost_info = $feed_model->find($repost_feed_id);
            if(!$repost_info){
                $result = array('code'=>ErrorCodeController::REPOST_CONTENT_NOT_NULL,'data'=>null,'info'=>'转发的原文不存在');
                echo json_encode($result);exit;
            }
            $feed_content = mb_strlen($feed_content, 'utf8') <= C('DOC_WORD_NUM') ? $feed_content : String::msubstr($feed_content, 0, C('DOC_WORD_NUM'));
            $data = array();
            $data['member_id']      = session('member_auth.mid');
            $data['repost_feed_id'] = $repost_feed_id;
            $data['is_repost']      = FEED_REPOST;
            $data['feed_content']   = $feed_content;
            $data['feed_ctime']     = NOW_TIME;
            $data['feed_status']    = STATUS_RESUME;
            $feed_id = $feed_model->add($data);
            if($feed_id){
                $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>1,'info'=>'转发成功');
                echo json_encode($result);exit;
            }else{
                $result = array('code'=>ErrorCodeController::NOT_FOUND,'data'=>0,'info'=>'转发失败');
                echo json_encode($result);exit;
            }
        }else{

             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求错误');
              echo json_encode($result);exit;
        }
    }
    /**
     * 删除分享--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  del
     * @param $feed_id   分享id
     * @param 
     */

    public function del($feed_id = 0){
        if(IS_POST){
            $member_id = session('member_auth.mid');
            if(isset($_POST['feed_id'])){
                $feed_id = $_POST['feed_id'];
            }else{
                 $result = array('code'=>ErrorCodeController::FEED_ID_NOT_NULL,'data'=>null,'info'=>'分享的id不能为空');
                 echo json_encode($result);exit;
            }
            $feed_model = D('Feed');
            $feed_info = $feed_model->find($feed_id);
            if(empty($feed_info)){
                $result = array('code'=>ErrorCodeController::NOT_FOUND,'data'=>null,'info'=>'分享不存在');
                echo json_encode($result);exit;
            }
            $where = array();
            $where['feed_id']   = $feed_id;
            $where['member_id'] = $member_id;
            
            $feed_info = $feed_model->where($where)->find();
            if(empty($feed_info)){
                $result = array('code'=>ErrorCodeController::NOT_DELETE_ANOTHER,'data'=>null,'info'=>'无法删除,不是自己的分享');
                echo json_encode($result);exit;
            }
            $data = array();
            $data['feed_id'] = $feed_id;
            $data['feed_status'] = STATUS_RECYCLE;
            
            $result = $feed_model->save($data);
            if($result !== false){
                $where = array();
                $where['feed_id'] = $feed_id;
                M('FeedFavorite')->where($where)->delete();
                 $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>1,'info'=>'删除成功');
                 echo json_encode($result);exit;
            }else{
                $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>0,'info'=>'删除失败');
                echo json_encode($result);exit;
            }

        }else{
             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求错误');
             echo json_encode($result);exit;
        }
    }
     public function getFavCount($map){
        return M('FeedFavorite')->where($map)->count();
    }

     public function getRepostCount($map){
        return M('Feed')->where($map)->count();
    }
    
    public function getCommentCount($map){
        return M('FeedComment')->where($map)->count();
    }

    /**
     * 分享榜。--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  feed_top
     * @param $type 分享榜类型 1 热搜榜 2 最新榜
     * @param 
     */
    public function feed_top(){
        if(IS_POST){
            $type = isset($_POST['type'])?$_POST['type']:1;
            $shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:"";
            $member_id = session('member_auth.mid');
            if($type == 1 && $shop_id==""){
                 $page_size = isset($_POST['page'])?$_POST['page']:10;
                 $where = array();
                 $count  = M('feed_favorite')
                      ->field('count(fa.feed_id) as count,fa.feed_id,f.member_id,fa.favorite_ctime,f.feed_content,f.feed_ctime')
                      ->alias("fa")
                      ->join('left join feed f on fa.feed_id = f.feed_id')
                      ->group('fa.feed_id')
                      ->count();
                 $Page       = new \Think\Page($count,$page_size); //分页类
                foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                    $Page->parameter[$key]   =   urlencode($val);
                }
                 $hot = M('feed_favorite')
                      ->field('count(fa.feed_id) as count,fa.feed_id,f.feed_title,f.member_id,fa.favorite_ctime,f.feed_content,f.feed_ctime,f.repost_feed_id')
                      ->alias("fa")
                      ->join('left join feed f on fa.feed_id = f.feed_id')
                      ->group('fa.feed_id')
                      ->page($page_size.',10')
                      ->order('count desc ')
                      ->select(); //获取热搜榜10条数据
                      //循环获取用户信息
                    foreach ($hot as $key => $value) {
                        $hot_member = M('member')
                                ->alias('m')
                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account,mw.headimgurl')
                                ->join('left join member_wechat mw on m.member_id = mw.member_id')
                                ->where(array('m.member_id'=>$value['member_id']))
                                ->find();
                        $hot[$key]['content'] = $value['feed_content'];
                        // $hot[$key]['content'] =  mb_strlen($value['feed_content'], 'utf8') <= C('DOC_WORD_NUM') ?$value['feed_content']: String::msubstr($value['feed_content'], 0, C('DOC_WORD_NUM'));  //需要函数处理
                        $hot[$key]['member_id']= $hot_member['member_id'];
                        $hot[$key]['member_name'] = $hot_member['member_name'];
                        $hot[$key]['headimgurl'] = $hot_member['headimgurl'];
                        $hot[$key]['member_avatar'] = get_cover($hot_member['member_avatar'], 'avatar');
                        $hot[$key]['info_url']      = U('Member/info', array('member_id'=>$hot_member['member_id']));
                        $list = D('FeedData')
                                    ->field('GROUP_CONCAT(cover_id) AS cover_ids')
                                    ->where(array('feed_id'=>$value['feed_id']))
                                    ->group('feed_id')
                                    ->select();
                        $num =  get_covers($list[0]['cover_ids']);

                        $hot[$key]['cover_url'] =  current($num) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
                        $hot[$key]['pics_url']      =  $num; // 所有
                        $hot[$key]['pics_count']    = count($num);
                        $hot[$key]['fav_count'] =  $this->getFavCount(array('feed_id' => $value['feed_id']));//获取点赞次数
                        $hot[$key]['comment_count'] = $this->getCommentCount(array('feed_id' => $value['feed_id']));//获取评论次数
                        $hot[$key]['repost_count']  =  $this->getRepostCount(array('repost_feed_id' => $value['feed_id']));//转发次数
                        $hot[$key]['is_fav'] = is_fav(session('member_auth.mid'), $value['feed_id']);//是否点赞
                        $hot[$key]['is_self'] = is_self(session('member_auth.mid'),$value['member_id']) ? 1 : 0;//是否自己点赞
                        $hot[$key]['is_follow'] = is_follow(session('member_auth.mid'),$value['member_id'] );
                        $hot[$key]['info_url']   = U('Feed/info', array('feed_id'=>$value['feed_id']));//信息url
                        $hot[$key]['repost_url'] = U('Feed/repost', array('feed_id'=>$value['feed_id']));//转发url
                        if($value['repost_feed_id']){
                            $hot[$key]['retweeted'] = $this->getInfo($value['repost_feed_id'], $member_id);
                        }
                        $hot[$key]['fav_list'] = M('feed_favorite')
                                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account')
                                                ->alias('fa')
                                                ->join("left join member m on m.member_id = fa.member_id")
                                                ->where('fa.feed_id = '.$value['feed_id'])
                                                ->order("fa.favorite_id ASC")
                                                ->select();
                         $comment_info = M('feed_comment')
                                                ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                                                ->alias("fc")
                                                ->join('left join member m on fc.member_id = m.member_id')
                                                ->where("fc.feed_id =".$value['feed_id']." and fc.comment_type = 0" )
                                                ->limit(2)
                                                ->order("fc.comment_ctime ASC")
                                                ->select();
                         $comment  = M('feed_comment')
                                                ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                                                ->alias("fc")
                                                ->join('left join member m on fc.member_id = m.member_id')
                                                ->where("fc.feed_id =".$value['feed_id'] )
                                                ->limit(2)
                                                ->order("fc.comment_ctime ASC")
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
                            $arr[$k]['comment_ctime']= $v['comment_ctime']; 
                            }
                        }
                        isset($arr)?$arr:"";
                        $hot[$key]['comment'] = array_merge($comment_info,$arr);//最后评论格式  合并 评论和回复评论的人
                        foreach ($hot[$key]['comment'] as $i => $j) {
                            $arr = array_map(create_function('$j', 'return $j["comment_ctime"];'), $hot[$key]['com']);//返回comment_ctime排序规则
                        }
                         array_multisort($arr,SORT_ASC,$hot[$key]['comment'] );//多维数组的排序
                    }



                    if(!empty($hot)){
                        $result = array('code'=>200,'data'=>$hot,'info'=>'success');
                        echo json_encode($result);exit;
                    }else{
                        $result = array('code'=>200,'data'=>[],'info'=>'faild');
                        echo json_encode($result);exit;
                    }
            }else if($type == 2 && $shop_id==""){
                $page_size = isset($_POST['page'])?$_POST['page']:10;
                $count  = M('feed')->order('feed_ctime desc')->count();
                $where = array();
                $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
                foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                    $Page->parameter[$key]   =   urlencode($val);
                }
                $new = M('feed')
                     ->field('feed_id,member_id,feed_content,feed_ctime,repost_feed_id,feed_title')
                      ->page($page_size.",10")
                     ->where($where)
                     ->order('feed_ctime DESC')
                     ->select();
                    foreach ($new as $key => $value) {
                        $new_member = M('member')
                                ->alias('m')
                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account,mw.headimgurl')
                                ->join('left join member_wechat mw on m.member_id = mw.member_id')
                                ->where(array('m.member_id'=>$value['member_id']))
                                ->find();
                         $new[$key]['content'] = $value['feed_content'];
                        //$new[$key]['content'] =  mb_strlen($value['feed_content'], 'utf8') <= C('DOC_WORD_NUM') ?$value['feed_content']: String::msubstr($value['feed_content'], 0, C('DOC_WORD_NUM'));  //需要函数处理
                        $new[$key]['member_id']= $new_member['member_id'];
                        $new[$key]['member_name'] = $new_member['member_name'];
                        $new[$key]['headimgurl'] = $new_member['headimgurl'];
                        $new[$key]['member_avatar'] = get_cover($hot_member['member_avatar'], 'avatar');
                        $new[$key]['info_url']      = U('Member/info', array('member_id'=>$hot_member['member_id']));
                        $list = D('FeedData')
                                    ->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                                    ->where(array('feed_id'=>$value['feed_id']))
                                    ->group('feed_id')
                                    ->select();
                        $num =  get_covers($list[0]['cover_ids']);
                        $new[$key]['cover_url'] =  current($num) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
                        $new[$key]['pics_url']      =  $num; // 所有
                        $new[$key]['pics_count']    = count($num);
                        $new[$key]['fav_count']     =  $this->getFavCount(array('feed_id' => $value['feed_id']));
                        $new[$key]['comment_count'] = $this->getCommentCount(array('feed_id' => $value['feed_id']));
                        $new[$key]['repost_count']  =  $this->getRepostCount(array('repost_feed_id' => $value['feed_id']));
                        $new[$key]['is_fav'] = is_fav(session('member_auth.mid'), $value['feed_id']);
                        $new[$key]['is_self'] = is_self(session('member_auth.mid'),$value['member_id'] ) ? 1 : 0;
                        $new[$key]['is_follow'] = is_follow(session('member_auth.mid'),$value['member_id']);
                        $new[$key]['info_url']   = U('Feed/info', array('feed_id'=>$value['feed_id']));
                        $new[$key]['repost_url'] = U('Feed/repost', array('feed_id'=>$value['feed_id']));
                          if($value['repost_feed_id']){
                                $new[$key]['retweeted'] = $this->getInfo($value['repost_feed_id'], $member_id);
                            }
                        $new[$key]['fav_list'] = M('feed_favorite')
                                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account')
                                                ->alias('fa')
                                                ->join("left join member m on m.member_id = fa.member_id")
                                                ->where('fa.feed_id = '.$value['feed_id'])
                                                ->order("fa.favorite_id ASC")
                                                ->select();
                         $comment_info = M('feed_comment')
                                                ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                                                ->alias("fc")
                                                ->join('left join member m on fc.member_id = m.member_id')
                                                ->where("fc.feed_id =".$value['feed_id']." and fc.comment_type = 0" )
                                                ->limit(2)
                                                ->order("fc.comment_ctime ASC")
                                                ->select();

                        $comment  = M('feed_comment')
                                                ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                                                ->alias("fc")
                                                ->join('left join member m on fc.member_id = m.member_id')
                                                ->where("fc.feed_id =".$value['feed_id']." and  fc.feed_id  = ".$value['feed_id'] )
                                                ->limit(2)
                                                ->order("fc.comment_ctime ASC")
                                                ->select();
                        $arr = array();
                        foreach ($comment as $k => $v) {
                            if($v['reply_comment_id'] !== 0 && $v['reply_comment_id']!=="0"){
                                $arr[$k] = M('feed_comment')
                                    ->field('fc.comment_id,fc.member_id,fc.comment_content,fc.comment_type,fc.reply_comment_id,fc.comment_ctime,m.member_name,m.member_wechat_account')
                                    ->alias('fc')
                                    ->join('left join member m on fc.member_id = m.member_id')
                                    ->where("fc.comment_id=".$v['reply_comment_id']." and ".$v['reply_comment_id']." <> 0 ")
                                    ->limit(2)
                                    ->order("fc.comment_ctime ASC")
                                    ->find();
                            $arr[$k]['rc_id']= $v['comment_id']; 
                            $arr[$k]['mid']= $v['member_id'];  
                            $arr[$k]['contents']= $v['comment_content'];
                            $arr[$k]['type']= $v['comment_type']; 
                            $arr[$k]['r_name']= $v['member_name']; 
                            $arr[$k]['rw_name']= $v['member_wechat_account']; 
                            $arr[$k]['comment_ctime']= $v['comment_ctime']; 
                            }
                        }
                        isset($arr)?$arr:"";
                        $new[$key]['comment'] = array_merge($comment_info,$arr);//最后评论格式
                        foreach ($new[$key]['comment'] as $i => $j) {
                            $arr = array_map(create_function('$j', 'return $j["comment_ctime"];'), $new[$key]['com']);//返回comment_ctime排序规则
                        }
                         array_multisort($arr,SORT_ASC,$new[$key]['comment'] );//多维数组的排序
                    }

                    $new = $this->my_sort($new,'comment_ctime',SORT_ASC,SORT_STRING);


                    if(!empty($new)){
                          $result = array('code'=>200,'data'=>$new,'info'=>'success'); 
                          echo json_encode($result);exit;
                    }else{
                         $result = array('code'=>200,'data'=>[],'info'=>'faild'); 
                         echo json_encode($result);exit;
                    }
            }else {
                //获取商户下
                $page_size = isset($_POST['page'])?$_POST['page']:10;
                $title = M('gy_document')
                        ->field("title")
                        ->where(array('id'=>$shop_id))
                        ->find();
                $where['feed_title']= $title['title'];
                $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
                foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                    $Page->parameter[$key]   =   urlencode($val);
                }
                $shop_list = M('feed')
                     ->field('*')
                     ->where($where)
                     ->order('feed_ctime desc')
                     ->page($page_size.",10")
                     ->select();
                      //循环获取用户信息
                    foreach ($shop_list as $key => $value) {
                         $member = M('member')
                                ->alias('m')
                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account,mw.headimgurl')
                                ->join('left join member_wechat mw on m.member_id = mw.member_id')
                                ->where(array('m.member_id'=>$value['member_id']))
                                ->find();
                         $shop_list[$key]['content'] =$value['feed_content'];
                        //$shop_list[$key]['content'] =   mb_strlen($value['feed_content'], 'utf8') <= C('DOC_WORD_NUM') ?$value['feed_content']: String::msubstr($value['feed_content'], 0, C('DOC_WORD_NUM'));  //需要函数处理
                        $shop_list[$key]['member_id']= $member['member_id'];
                        $shop_list[$key]['member_name'] = $member['member_name'];
                        $shop_list[$key]['headimgurl'] = $member['headimgurl'];
                        $shop_list[$key]['member_avatar'] = get_cover($member['member_avatar'], 'avatar');
                        $shop_list[$key]['info_url']      = U('Member/info', array('member_id'=>$member['member_id']));
                        $list = D('FeedData')
                                    ->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                                    ->where(array('feed_id'=>$value['feed_id']))
                                    ->group('feed_id')
                                    ->select();
                        $num =  get_covers($list[0]['cover_ids']);
                        $shop_list[$key]['cover_url'] =  current($num) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
                        $shop_list[$key]['pics_url']      =  $num; // 所有
                        $shop_list[$key]['pics_count']    = count($num);
                        $shop_list[$key]['fav_count'] =  $this->getFavCount(array('feed_id' => $value['feed_id']));//获取点赞次数
                        $shop_list[$key]['comment_count'] = $this->getCommentCount(array('feed_id' => $value['feed_id']));//获取评论次数
                        $shop_list[$key]['repost_count']  =  $this->getRepostCount(array('repost_feed_id' => $value['feed_id']));//转发次数
                        $shop_list[$key]['is_fav'] = is_fav(session('member_auth.mid'), $value['feed_id']);//是否点赞
                        $shop_list[$key]['is_self'] = is_self(session('member_auth.mid'),$value['member_id']) ? 1 : 0;//是否自己点赞
                        $shop_list[$key]['is_follow'] = is_follow(session('member_auth.mid'),$value['member_id'] );
                        $shop_list[$key]['info_url']   = U('Feed/info', array('feed_id'=>$value['feed_id']));//信息url
                        $shop_list[$key]['repost_url'] = U('Feed/repost', array('feed_id'=>$value['feed_id']));//转发url
                        if($value['repost_feed_id']){
                            $shop_list[$key]['retweeted'] = $this->getInfo($value['repost_feed_id'],$member_id);
                        }
                        $shop_list[$key]['fav_list'] = M('feed_favorite')
                                                ->field('m.member_id,m.member_name,m.member_avatar,m.member_wechat_account')
                                                ->alias('fa')
                                                ->join("left join member m on m.member_id = fa.member_id")
                                                ->where('fa.feed_id = '.$value['feed_id'])
                                                ->order("fa.favorite_id asc")
                                                ->select();
                        $comment_info = M('feed_comment')
                                                ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                                                ->alias("fc")
                                                ->join('left join member m on fc.member_id = m.member_id')
                                                ->where("fc.feed_id =".$value['feed_id']." and fc.comment_type = 0" )
                                                ->limit(2)
                                                ->order("fc.comment_ctime asc")
                                                ->select();
                                            
                         $comment  = M('feed_comment')
                                                ->field('fc.comment_id,fc.comment_type,fc.reply_comment_id,fc.member_id,fc.comment_ctime,fc.comment_content,m.member_name,m.member_wechat_account')
                                                ->alias("fc")
                                                ->join('left join member m on fc.member_id = m.member_id')
                                                ->where("fc.feed_id =".$value['feed_id']." and  fc.feed_id  = ".$value['feed_id'] )
                                                ->limit(2)
                                                ->order("fc.comment_ctime asc")
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
                                    ->order("fc.comment_ctime asc")
                                    ->find();
                            $arr[$k]['rc_id']= $v['comment_id']; 
                            $arr[$k]['mid']= $v['member_id'];  
                            $arr[$k]['contents']= $v['comment_content'];
                            $arr[$k]['comment_type']= $v['comment_type']; 
                            $arr[$k]['r_name']= $v['member_name']; 
                            $arr[$k]['rw_name']= $v['member_wechat_account']; 
                            $arr[$k]['comment_ctime']= $v['comment_ctime']; 
                            }
                        }
                        isset($arr)?$arr:"";
                        $shop_list[$key]['comment'] = array_merge($comment_info,$arr);//最后评论格式  合并 评论和回复评论的人
                        foreach ($shop_list[$key]['comment'] as $i => $j) {
                            $arr = array_map(create_function('$j', 'return $j["comment_ctime"];'), $shop_list[$key]['com']);//返回comment_ctime排序规则
                        }
                         array_multisort($arr,SORT_ASC,$shop_list[$key]['comment'] );//多维数组的排序
                    }
                    
                    $shop_list = $this->my_sort($shop_list,'comment_ctime',SORT_ASC,SORT_STRING);


                     if(!empty($shop_list)){
                          $result = array('code'=>200,'data'=>$shop_list,'info'=>'success'); 
                          echo json_encode($result);exit;
                    }else{
                         $result = array('code'=>200,'data'=>[],'info'=>'faild'); 
                         echo json_encode($result);exit;
                    }
            }
        }else{
            $result = array('code'=>404,'data'=>null,'info'=>'faild');
        }
         echo json_encode($result); exit;
    }



    /**
     * 发布分享--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  uploadWechat
     * @param 
     * @param 
     */


    public function uploadImgbs(){
        //base64_decode();
        $data = $this->saveBase64Image($_POST['imgs']);
        echo json_encode( $data);exit;
    }



/**
 * 保存64位编码图片
 */

 public function saveBase64Image($base64_image_content){

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){

                  //图片后缀
                  $type = $result[2];

                  //保存位置--图片名
                  $image_name=date('His').str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT).".".$type;
                  $image_url = '/Uploads/wechat/'.date('Ymd').'/'.$image_name;         
                  if(!is_dir(dirname('.'.$image_url))){
                         mkdir(dirname('.'.$image_url),0777, true);
                        chmod(dirname('.'.$image_url), 0777);
                        umask($oldumask);
                  }
                  //解码
                  $decode=base64_decode(str_replace($result[1], '', $base64_image_content));
                  if (file_put_contents('.'.$image_url, $decode)){
                        $data = array('url'=>$image_url,'name'=>$image_name);
                        $result  = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'success');
                        echo json_encode( $result);exit;
                  }else{
                        $result  = array('code'=>ErrorCodeController::NOT_FOUND,'data'=>null,'NOT_FOUND');
                        echo json_encode( $result);exit;
                  }
        }else{
            $result  = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'REQUEST_ERROR');
            echo json_encode( $result);exit;
        }       
        return $data;
 }





    /**
     * 微信上传--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  uploadWechat
     * @param 
     * @param 
     */
    // private function uploadWechat($media_id){
    //     $media = $this->tpWechat->getMediaAll($media_id);
    
    //     if(!$media){
    //         $return['error']   = 1;
    //         $return['message'] = '上传出错,'.$this->tpWechat->errMsg;
    //         return $return;
    //     }
    
    //     $subpath  = date('Y-m-d', NOW_TIME).'/';
    //     $savepath = './Uploads/wechat/'.$subpath;
    
    //     if(!is_dir($savepath)){
    //         if(!mkdir($savepath, 0777, true)){
    //             $return['error']   = 1;
    //             $return['message'] = '上传出错,新建目录失败';
    //             return $return;
    //         }
    //     }
    //     // 求出文件格式
    //     preg_match('/\w\/(\w+)/i', $media["content_type"], $extMatches);
    
    //     $fileExt  = $extMatches[1];
    //     $savename = uniqid().'.'.$fileExt;
    //     $filename = $media_id.'.'.$fileExt;
    //     $filePath = $savepath.$savename;
    
    //     $result = file_put_contents($filePath, $media['mediaBody']);
    //     if(!$result){
    //         $return['error']   = 1;
    //         $return['message'] = '上传出错,保存到服务器失败';
    //         return $return;
    //     }
    //     // 存入数据库
    //     $file = [];
    //     $file['name'] = $filename;
    //     $file['path'] = '/Uploads/wechat/'.$subpath.$savename;
    //     $file['ext']  = $fileExt;
    //     $file['size'] = filesize($filePath);
    //     $file['md5']  = md5_file($filePath);
    //     $file['sha1'] = sha1_file($filePath);
    //     $file['location'] = C('UPLOAD_DRIVER');
    
    //     //
    //     $where = array();
    //     $where['md5']  = $file['md5'];
    //     $where['sha1'] = $file['sha1'];
    //     $where['size'] = $file['size'];
    
    //     $upload_model = D('PublicUpload');
    //     $upload = $upload_model->where($where)->find();
    
    //     if($upload){ //发现相同文件直接返回
    //         $return['id']   = $upload['id'];
    //         $return['name'] = $upload['name'];
    //         $return['url']  = $upload['real_path'];
    
    //         //
    //         unlink($filePath);
    //     }else{
    //         $data = $upload_model->create($file);
    //         if(!$data){
    //             $return['error']   = 1;
    //             $return['message'] = '上传出错,'.$upload_model->getError();
    //             return $return;
    //         }
    
    //         $id   = $upload_model->add($data);
    //         if($result){
    //             $return['id']   = $id;
    //             $return['name'] = $file['name'];
    //             $return['url']  = __ROOT__ . $file['path'];
    //         }else{
    //             $return['error']   = 1;
    //             $return['message'] = '上传出错,保存数据库失败';
    //         }
    //     }
    
    //     return $return;
    // }


     function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){  
        if(is_array($arrays)){  
            foreach ($arrays as $array){  
                if(is_array($array)){  
                    $key_arrays[] = $array[$sort_key];  
                }else{  
                    return false;  
                }  
            }  
        }else{  
            return false;  
        } 
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);  
        return $arrays;  
    } 





}