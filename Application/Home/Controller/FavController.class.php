<?php
namespace Home\Controller;
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class FavController extends HomeController{
    
    /**
     * 收藏点赞--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  del
     * @param $feed_id   分享id
     * @param 
     */
    public function add(){
        if(IS_POST){
            $feed_id = $_POST['feed_id'];
            if(!$feed_id){
                $result = array("code"=>500,'data'=>null,'info'=>'未传入点赞id');
                echo json_encode($result);exit;
            }
            $feed_info = M('Feed')->find($feed_id);
            if(!$feed_info){
                $result = array("code"=>404,'data'=>null,'info'=>'分享不存在');
                echo json_encode($result);exit;
            }
            $data = array();
            $data['feed_id']        = $feed_id;
            $data['member_id']      = session('member_auth.mid');
            $fav_model = D('FeedFavorite');
            $data = $fav_model->create($data);
            if(!$data){
                $result = array("code"=>500,'data'=>null,'info'=>'不能重复点赞了');
                echo json_encode($result);exit;
            }
            $fav_id = D('FeedFavorite')->add($data);
            if(!$fav_id){
                $result = array("code"=>500,'data'=>null,'info'=>'点赞失败');
                echo json_encode($result);exit;
            }
            $member_info = M('member')
                        ->field('member_name')
                        ->where('member_id ='.session('member_auth.mid'))
                        ->find();
            $result  = array('code'=>200,'data'=>$member_info,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>500,'data'=>null,'info'=>'faild');
            echo json_encode($result);exit;
        }

    }

    /**
     * 删除点赞--by xiewen
     * 
     * @var object
     * @access mysql
     * @param $feed_id   分享id
     * @param  
     */
    public function del(){
        $feed_id = $_POST['feed_id'];
        if(!$feed_id){
            $this->error('参数错误');
        }
        $where = array();
        $where['feed_id'] = $feed_id;
        $where['member_id'] = session('member_auth.mid');
        $fav_model = D('FeedFavorite');
        $result = $fav_model->where($where)->delete();
        if($result != false){
            $member_info = M('member')
                        ->field('member_name')
                        ->where('member_id ='.session('member_auth.mid'))
                        ->find();
            $result = array('code'=>200,'data'=>$member_info,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>404,'data'=>0,'info'=>'faild');
            echo json_encode($result);exit;
        }
    }
}