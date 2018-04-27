<?php
namespace Home\Controller;
use Common\Controller\ErrorCodeController;
use Common\Controller\WechatController;
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class MemberController extends HomeController{
        
    /**
     * 会员信息--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  info
     * @param 
     * @param 
     */
    public function info(){
        if(IS_POST){
                if(isset($_POST['member_id']) && $_POST['member_id']!==""){
                    $member_id  = $_POST['member_id'];
                }else{
                    $member_id =  session('member_auth.mid');
                }
                $member_info =  D('Member')
                            ->field('m.member_id,m.member_name,m.member_avatar,mw.headimgurl')
                            ->alias('m')
                            ->join('left join member_wechat mw on m.member_id  = mw.member_id')
                            ->where('m.member_id = '.$member_id)
                            ->find();
                if(!$member_info){
                    $result = array('code'=>ErrorCodeController::USER_IS_EXISTS,'data'=>null,'info'=>'用户不存在');
                    echo json_encode( $result);exit;
                }
                $this->member_info = $member_info;
                $this->is_self     = is_self(session('member_auth.mid'),$member_id )? 1 : 0;
                $this->is_follow   = is_follow(session('member_auth.mid'),$member_id);
                $follow_model = D('MemberFollow');
                $this->follow_count = $follow_model->getFollowCount($member_id);
                $this->fans_count   = $follow_model->getFansCount($member_id);
                $where = array();
                $where['member_id'] = $member_id;
                $fav_model = D('FeedFavorite');
                $this->fav_count = $fav_model->getFavCount($where);
                $message_model = D('Message');
                $this->message_count = $message_model->getHaventReadMessageCount($member_id);
                $data = array('member_info'=> $this->member_info,'is_self'=>$this->is_self,'is_follow'=>$this->is_follow,'follow_count'=>$this->follow_count,'fans_count'=>$this->fans_count,'fav_count'=>$this->fav_count,'message_count'=>$this->message_count);
                $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success'); 
                echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求错误');
            echo json_encode( $result);exit;
        }
    }
    /**
     * 获取关注列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  follow
     * @param description 我关注的会员
     * @param  $member_id 会员id
     * @param 
     */
    public function follow(){
        if(IS_POST){
                 $member_id  = session('member_auth.mid'); 
                if(isset($_POST['page']) && $_POST['page']!==""){
                $page_size = $_POST['page'];
                }else{
                    $page_size = 1;
                }
                if(isset($_POST['member_id']) and $_POST['member_id']!==""){
                    $member_id = $_POST['member_id'];
                }else{
                     $member_id =session('member_auth.mid');
                }
                $where['mf.member_id'] =$member_id;
                $count      = M('member_follow')
                           ->alias('mf')
                           ->where($where)
                           ->count();// 查询满足要求的总记录数
                $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
                foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                    $Page->parameter[$key]   =   urlencode($val);
                }
                $data = M('MemberFollow')
                 ->alias('mf')
                 ->field('m.member_name,m.member_avatar,mf.follow_ctime,mf.follow_member_id,mf.member_id,mf.follow_id,mw.headimgurl')
                 ->join('left join member m on mf.follow_member_id = m.member_id ')
                 ->join('left join member_wechat mw on mf.follow_member_id = mw.member_id')
                 ->where($where)
                 ->page($page_size.",10")
                 ->select();
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>$data,'info'=>'请求错误');
            echo json_encode($result);exit;
        }
    }
    /**
     * 获取粉丝列表--by xiewen
     * 
     * @var object
     * @access mysql  
     * @fun  fans
     * @param desc 别人关注我的
     * @param  $member_id 会员id
     * @param 
     */
    public function fans(){
         $member_id  =session('member_auth.mid'); 
        if(IS_POST){
            if(isset($_POST['page']) && $_POST['page']!==""){
                $page_size = $_POST['page'];
            }else{
                $page_size = 1;
            }
            if(isset($_POST['member_id']) && $_POST['member_id']!==""){
                 $member_id = $_POST['member_id'];
            }else{
                 $member_id = session('member_auth.mid');
            }
           $where['mf.follow_member_id'] =$member_id;
            $count      = M('member_follow')
                           ->alias('mf')
                           ->where($where)
                           ->count();// 查询满足要求的总记录数
                $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
            foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                    $Page->parameter[$key]   =   urlencode($val);
            }
            $data = M('MemberFollow')
                 ->alias('mf')
                 ->field('m.member_name,m.member_avatar,mf.follow_ctime,mf.follow_member_id,mf.member_id,mf.follow_id,mw.headimgurl')
                 ->join('left join member m on mf.member_id = m.member_id ')
                 ->join('left join member_wechat mw on mf.member_id = mw.member_id')
                 ->where($where)
                 ->page($page_size.",10")
                 ->select();
            $list = array();
            foreach ($data as $key => $value) {
               $list[$key]['member_name'] = $value['member_name'];
               $list[$key]['member_avatar'] = $value['member_avatar'];
               $list[$key]['follow_ctime'] = $value['follow_ctime'];
               $list[$key]['follow_member_id'] = $value['member_id'];
               $list[$key]['member_id'] = $value['follow_member_id'];
               $list[$key]['follow_id'] = $value['follow_id'];
               $list[$key]['headimgurl'] = $value['headimgurl'];
            }

            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$list,'info'=>'success');
            echo json_encode($result);exit;
        }else{
             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>$list,'info'=>'请求错误');
            echo json_encode($result);exit;
        }
    }

    /**
     * 获取喜欢列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  fav
     * @param  $member_id 会员id
     * @param 
     */ 
    public function fav(){
         if(IS_POST){
            if(isset($_POST['page']) && $_POST['page']!=="" && $_POST['page']!==0){
                 $page_size = $_POST['page'];
            }else{
                 $page_size = 1;
            }
            if(isset($_POST['member_id']) and $_POST['member_id']!=="" ){
                $member_id = $_POST['member_id'];
            }else{
                 $member_id = session('member_auth.mid');
            }
            $where['fa.member_id'] =  $member_id;
            $count      = M('FeedFavorite')->alias('fa')->where($where)->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
            foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                $Page->parameter[$key]   =   urlencode($val);
            }
            $fav_list = M('FeedFavorite')
                 ->alias('fa')
                 ->field('fa.*,f.*')
                 ->join('left join feed f on fa.feed_id = f.feed_id')
                 ->where($where)
                  ->order('fa.favorite_ctime')
                  ->page($page_size.',10')
                 ->select();
            foreach ($fav_list as $key => $value) {
                $list = D('FeedData')
                        ->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                        ->where(array('feed_id'=>$value['feed_id']))
                        ->group('feed_id')
                        ->select();
                $num =  get_covers($list[0]['cover_ids']);
                $fav_list[$key]['cover_url'] =  current($num) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
                $fav_list[$key]['pics_url']      =$num; // 所有
                $fav_list[$key]['pics_count']    = count($num);
            }
            if($fav_list){
                 $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$fav_list,'info'=>'success');
                 echo json_encode($result);exit;
            }else{
                 $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>[],'info'=>'faild');
                 echo json_encode($result);exit;
            }
         } else{
             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>$null,'info'=>'faild');
             echo json_encode($result);exit; 
         }
    }



}