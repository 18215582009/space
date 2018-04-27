<?php
namespace Home\Controller;
use Common\Controller\ErrorCodeController;
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
class FollowController extends HomeController{
        
    /**
     * 关注--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  del
     * @param $follow_member_id   关注人的会员id
     * @param 
     */
    public function add(){
        if(IS_POST){           
            if(isset($_POST['follow_member_id']) and  $_POST['follow_member_id']!==""){
                 $follow_member_id = $_POST['follow_member_id'];
            }else{
                $result = array('code'=>ErrorCodeController::FOLLOW_ID_NOT_NULL,'data'=>null,'info'=>'关注id不能为空');
                echo json_encode($result);exit;
            }
            $data = array();
            $data['member_id']        = session('member_auth.mid');
            $data['follow_member_id'] = $follow_member_id;
            $data['follow_ctime'] = NOW_TIME;
            $member_follow_model = D('MemberFollow');
            if($data['follow_member_id'] == $data['member_id']){
                $result = array('code'=>ErrorCodeController::NOT_FOLLOW_SELF,'data'=>null,'info'=>'不能关注自己');
                echo json_encode($result);exit;
            }
            $cdata = $member_follow_model->create($data);
            if(!$cdata){
                $res->$member_follow_model->save($data); // 根据条件更新记录
                $result = array('code'=>ErrorCodeController::FOLLOW_ALREADY,'data'=>null,'info'=>'已经关注该用户');
                echo json_encode($result);exit;
                // $this->error($member_follow_model->getError());
            }
            $follow_id = $member_follow_model->add($data);
            if($follow_id){
                $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>1,'info'=>'success');
                echo json_encode($result);exit;
            }else{
                $result = array('code'=>ErrorCodeController::NOT_FOUND,'data'=>0,'info'=>'faild');
            }        
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'faild');
            echo json_encode($result);exit;
        }
    }

    /**
     * 关注删除--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  del
     * @param $follow_member_id   关注人的会员id
     * @param 
     */
    public function del(){
        if(IS_POST){
            // $follow_member_id = I('follow_member_id', 0, 'intval');
            $follow_member_id = $_POST['follow_member_id'];
            if(!$follow_member_id){
                $this->error('参数错误');
            }
            $where = array();
            $where['member_id']        = session('member_auth.mid');
            $where['follow_member_id'] = $follow_member_id;
            $result = D('MemberFollow')->where($where)->delete();
            if($result != false){
                $result = array('code'=>200,'data'=>1,'info'=>'success');
                echo json_encode($result);exit;
            }else{
                $result = array('code'=>404,'data'=>0,'info'=>'faild');
                echo json_encode($result);exit;
            }
        }else{
            $result = array('code'=>500,'data'=>null,'faild'=>'faild');
            echo json_encode($result);exit;
        }        
        
    }
     /**
     * 关注列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  page
     * @param $page 页数  $member_id 会员id  type：follow 我关注的人  fans 关注我的人
     * @param 
     */

    public function page(){
        // $page = I('page', 1, 'intval');
        // $member_id = I('member_id', 0, 'intval');
        if(IS_POST){
            $page = isset($_POST['page'])?$_POST['page']:1;
            $member_id = isset($_POST['member_id'])?$_POST['member_id']:0;
            $type = isset($_POST['type'])?$_POST['type']:"";
            $follow_model = D('MemberFollow');
            $follow_list = $follow_model->getMemberList($page, $member_id, $type);            
            if(!$follow_list){
                $this->ajaxReturn(array('follow_list'=>array()));
            }
            foreach ($follow_list as &$info){
                $info['info_url'] = U('Member/info', array('member_id'=>$info['member_id']));
                $info['member_avatar'] = get_cover($info['member_avatar'], 'avatar');
            }
            $info  = array('follow_list'=>$follow_list);
            $result = array('code'=>200,'data'=>$info,'info'=>'success');
            echo json_encode($result);
        }else{
            $result = array('code'=>500,'data'=>null,'info'=>'faild');
            echo json_encode($result);exit;

        }        
    }
}