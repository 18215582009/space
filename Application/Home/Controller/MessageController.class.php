<?php
namespace Home\Controller;
use Common\Controller\ErrorCodeController;
use Common\Controller\WechatController;

header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:*');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class MessageController extends HomeController {
    
     /**
     * 消息列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  page
     * @param  $member_id 会员id
     * @param 
     */    
    public function page(){
        if(IS_POST){
            // $member_id = I('member_id', 0, 'intval');
            $member_id = session('member_auth.mid');
            // if(isset($_POST['page']) and $_POST['page']!==""){
            //     $page_size = $_POST['page'];

            // }else{
            //    $page_size = 1;
            // }
            $message_model = D('Message');
            $message_list = $message_model->getHaventReadMessage($member_id);
            foreach ($message_list as $key => $value) {
                $member =  D('Member')
                            ->field('m.member_id,m.member_name,m.member_avatar,mw.headimgurl')
                            ->alias('m')
                            ->join('left join member_wechat mw on m.member_id  = mw.member_id')
                            ->where('m.member_id ='.$value['from_uid'])
                            ->find(); 
                $message_list[$key]['member']['member_name'] = $member['member_name'];
                $message_list[$key]['member']['headimgurl'] =  $member['headimgurl'];
                $list = D('FeedData')
                   ->field('feed_id, GROUP_CONCAT(cover_id) AS cover_ids')
                   ->where(array('feed_id'=>$value['content']['args']['feed_id']))
                   ->group('feed_id')
                   ->select();
                $num =  get_covers($list[0]['cover_ids']);
                $message_list[$key]['cover_url'] =  current($num) ? : C('TMPL_PARSE_STRING.__IMG__').'/feed-defalut.jpg'; // 第一张
                $message_list[$key]['pics_url']      = $num; // 所有
                $message_list[$key]['pics_count']    = count($num);
            }
            $data = array('message_list'=>$message_list);
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求错误');
            echo json_encode( $result);exit;
        }
    }

     /**
     * 是否阅读消息非私信--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  readMessage
     * @param  $member_id 会员id
     * @param 
     */   
    
    public function readMessage(){
        if(IS_POST){
            if(isset($_POST['message_id'])){
                $message_id = $_POST['message_id'];
            }else{
                $result = array('code'=>ErrorCodeController::MESSAGE_ID_NOT_NULL,'data'=>null,'info'=>'消息id不能为空');
                echo json_encode($result);exit;
            }
            $message_model = D('Message');
            $data = $message_model->readMessage($message_id);
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$data,'info'=>'success');
            echo json_encode($result);exit;
        }else{
             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'请求错误');
             echo json_encode( $result); exit;
        }
     
    }

     /**
     * 发送私信--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  send_UserMessage
     * @param  
     * @param 
     */   
     public function send_UserMessage(){
        $member_id = session('member_auth.mid');
        if(IS_POST){
            if(isset($_POST['member_id']) and $_POST['member_id'] !==""){
                 $to_uid =$_POST['member_id'];
            }else{
                 $result = array('code'=>ErrorCodeController::USERID_NOT_NULL,'data'=>null,'info'=>'私信的用户id不能为空');
                 echo json_encode($result);exit;
            }
            if($to_uid ==  $member_id){
                  $result = array('code'=>ErrorCodeController::NOT_SEND_SELF,'data'=>null,'info'=>'不能私信自己');
                 echo json_encode($result);exit;
            }
            if(isset($_POST['content'])){
                $content = $_POST['content'];
            }else{
                 $result = array('code'=>ErrorCodeController::CONTENTS_NOT_NULL,'data'=>null,'info'=>'私信内容不能为空');
                 echo json_encode($result);exit;
            }

            $where = array('from_user_id'=> $member_id,'to_user_id'=>$to_uid,'content'=>$content,'info_time'=>NOW_TIME,'is_read'=>0);
            $data = M('infomation')
                  ->add($where);

            $info = M('infomation')
                  ->alias('ms')
                  ->field('ms.info_time,m.member_name,mw.nickname,m.member_wechat_account,mw.headimgurl')
                  ->join('left join member m on ms.from_user_id = m.member_id')
                  ->join('left join member_wechat mw on ms.from_user_id = mw.member_id')
                  ->where('ms.id ='.$data)
                  ->find();
            if(!$data){
                 $result = array('code'=>ErrorCodeController::CREATE_INFO_FAILD,'data'=>null,'info'=>'发送失败');
                 echo json_encode($result);exit;
            }else{
                  $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$info,'info'=>'发送成功');
                  echo json_encode($result);exit;
            }
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>1,'info'=>'请求错误');
            echo json_encode($result);exit;
        }
        
     }
      /**
     * 获取私信列表--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  get_WithoutReadMessage
     * @param  
     * @param 
     */   
      public function get_Message(){
        if(IS_POST){
            $page_size = isset($_POST['page'])?$_POST['page']:1;
            if(isset($_POST['member_id'])){
                $member_id = $_POST['member_id'];
            }else{
                 $member_id = session('member_auth.mid');
            }
            $where['to_user_id'] = $member_id;
            $where['is_read'] = 0;
            $count      = M('infomation')->where($where)->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
            foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
                $Page->parameter[$key]   =   urlencode($val);
            }
            $messages = M('infomation')
                    ->where($where)
                    ->order('id desc')
                    ->page($page_size.',10')
                    ->select();
            foreach ($messages as $key => $value) {
                $member_from = M('member')
                        ->alias("m")
                        ->field('m.member_name,m.member_wechat_account,mw.headimgurl,mw.nickname')
                        ->join("left join member_wechat mw on m.member_id = mw.member_id")
                        ->where('m.member_id = '.$value['from_user_id'])
                        ->find();
                $member = M('member')
                        ->alias("m")
                        ->field('m.member_name,m.member_wechat_account,mw.headimgurl,mw.nickname')
                        ->join("left join member_wechat mw on m.member_id = mw.member_id")
                        ->where('m.member_id = '.$value['to_user_id'])
                        ->find();
                $messages[$key]['self_member_name'] =  $member['member_name'];
                $messages[$key]['self_member_wechat_account'] = $member['member_wechat_account'];
                $messages[$key]['self_headimgurl'] = $member['headimgurl'];
                $messages[$key]['self_nickname'] = $member['nickname'];
                $messages[$key]['from_member_name'] =  $member_from['member_name'];
                $messages[$key]['from_member_wechat_account'] = $member_from['member_wechat_account'];
                $messages[$key]['from_headimgurl'] = $member_from['headimgurl'];
                $messages[$key]['from_nickname'] = $member_from['nickname'];
            }
            $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$messages,'info'=>'success');
            echo json_encode($result);exit;
        }else{
            $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>1,'info'=>'请求错误');
            echo json_encode($result);exit;
        }
      }
   

       /**
     * 获取正在交谈对象--by xiewen
     * 
     * @var object
     * @access mysql
     * @fun  get_ConnectMessage
     * @param  
     * @param 
     */   

    public function get_ConnectMessage(){
        if(IS_POST){
            // $from_page_size  = isset($_POST['from_page'])?$_POST['from_page']:1;
            // $self_page_size = isset($_POST['self_page'])?$_POST['self_page']:1;
            if(isset($_POST['member_id']) and $_POST['member_id']!==""){
                $member_id = $_POST['member_id'];
                if($member_id  ==  session('member_auth.mid')){
                    $result = array('code'=>ErrorCodeController::NOT_SEND_SELF,'data'=>null,'info'=>'不能私信自己');
                    echo json_encode($result);exit;
                }   
            }else{
                 $result = array('code'=>ErrorCodeController::USERID_NOT_NULL,'data'=>null,'info'=>'用户id不能为空');
                 echo json_encode($result);exit;
            }
            if(isset($_POST['message_id']) and $_POST['message_id']!==""){
                $message_id = $_POST['message_id'];
                if($message_id){
                    $status = M('infomation')
                            ->field('is_read')
                            ->where('id = '.$message_id.' and from_user_id = '.$member_id." and to_user_id =". $member_id)
                            ->find();
                    if($status['is_read'] == 0 || $status['is_read'] == 1){
                            $up_where['is_read'] = 1;
                            $up_where['id'] = $message_id;
                            $data = M('infomation')->save($up_where);
     
                    }else{
                        $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>null,'info'=>'数据错误');
                        echo json_encode($result);exit; 
                    }
                }
            }
            $from_where['ms.from_user_id'] = $member_id;
            $from_where['ms.to_user_id'] = session('member_auth.mid');
            $from_message_data = M('infomation')
                          ->alias('ms')
                          ->field('ms.*,m.member_name,m.member_wechat_account,mw.nickname,mw.headimgurl')
                          ->join('left join member m on ms.from_user_id = m.member_id')
                          ->join('left join member_wechat mw on ms.from_user_id = mw.member_id')
                          ->where($from_where)
                          ->select();
            $from_data = array();
            foreach ($from_message_data as $key => $value) {
               $from_data[$key] = $value;
               $from_data[$key]['is_self'] = 0;
            }

            //我发送的信息
            $self_where['ms.from_user_id'] =  session('member_auth.mid');
            $self_where['ms.to_user_id'] = $member_id;
            // $count  = M('infomation') ->query('select count(infomation.id) as count from infomation  where to_user_id ='.$this->mid);
            // $Page       = new \Think\Page($count,$from_page_size);// 实例化分页类 传入总记录数和每页显示的记录数
            // foreach($self_where as $key=>$val) {    //分页跳转的时候保证查询条件
            //     $Page->parameter[$key]   =   urlencode($val);
            // }
            $self_message_data = M('infomation')
                        ->alias('ms')
                          ->field('ms.*,m.member_name,m.member_wechat_account,mw.nickname,mw.headimgurl')
                          ->join('left join member m on ms.from_user_id = m.member_id')
                          ->join('left join member_wechat mw on ms.from_user_id = mw.member_id')
                          ->where($self_where)
                          // ->page($page_size.',2')
                          ->select();
            $self_data = array();
            foreach ($self_message_data as $key => $value) {
               $self_data[$key] = $value;
               $self_data[$key]['is_self'] = 1;
            }

            $messages = array_merge($from_data,$self_data);//最后评论格式  合并 评论和回复评论的人
            foreach ($messages as $i => $j) {
                $arr = array_map(create_function('$j', 'return $j["info_time"];'), $messages);//返回comment_ctime排序规则
            }
           array_multisort($arr,SORT_ASC,$messages);//多维数组的排序
           if($messages){
               $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$messages,'info'=>'success');
               echo json_encode($result);exit;
           }else{
               $result = array('code'=>ErrorCodeController::SUCCESS,'data'=>$messages,'info'=>'NOT_FOUND');
               echo json_encode($result);exit;
           }           
        }else{
             $result = array('code'=>ErrorCodeController::REQUEST_ERROR,'data'=>1,'info'=>'请求错误');
             echo json_encode($result);exit;
        }
    }


}