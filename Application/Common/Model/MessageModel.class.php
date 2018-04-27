<?php
namespace Common\Model;
use Think\Model;
class MessageModel extends Model{
    
    public function sendMessage($to_uids, $title = '您有新的消息', $content = '', $url = '', $url_args = array(), $from_uid = -1, $type = 0){
        $from_uid == -1 && $from_uid = is_login();
        $to_uids = is_array($to_uids) ? $to_uids : array($to_uids);
        
        $k = array_search($from_uid, $to_uids);
        if($k !== false){
            unset($to_uids[$k]);
        }
        
        if(count($to_uids) > 0){
            return $this->sendMessageWithoutCheckSelf($to_uids, $title, $content, $url, $url_args, $from_uid, $type);
        }else{
            return false;
        }
    }
    
    public function sendMessageWithoutCheckSelf($to_uids, $title = '您有新的消息', $content = '', $url = '', $url_args = array(), $from_uid = -1, $type = 0){
        $from_uid == -1 && $from_uid = is_login();
        $message_content_id = $this->addMessageContent($from_uid, $title, $content, $url, $url_args, $type);
        $to_uids = is_array($to_uids) ? $to_uids : array($to_uids);

        foreach ($to_uids as $to_uid){
            $message = array();
            $message['message_content_id'] = $message_content_id;
            $message['to_uid'] = $to_uid;
            $message['from_uid'] = $from_uid;
            $message['create_time'] = NOW_TIME;
            $this->add($message);
        }
    }
    
    public function addMessageContent($from_uid, $title, $content, $url, $url_args, $type){
        $data_content['from_uid'] = $from_uid;
        $data_content['title'] = $title;
        $data_content['content'] = $content;
        $data_content['url'] = $url;
        $data_content['args'] = empty($url_args) ? '' : json_encode($url_args);
        $data_content['type'] = $type;
        $data_content['create_time'] = NOW_TIME;
        $message_content_id = D('MessageContent')->add($data_content);
        return $message_content_id ? : 0;
    }
    
    public function getHaventReadMessage($to_uid){
        $where = array();
        $where['to_uid'] = $to_uid;
        $where['is_read'] = 0;
        // $count      = $this->where($where)->count();// 查询满足要求的总记录数
        // $Page       = new \Think\Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
        // foreach($where as $key=>$val) {    //分页跳转的时候保证查询条件
        //         $Page->parameter[$key]   =   urlencode($val);
        // }
        $messages = $this->where($where)->order('message_id desc')->select();
        foreach ($messages as &$message){
            $message['ctime'] = friendly_date($message['create_time']);
            $message['content'] = $this->getContent($message['message_content_id']);
        }
        unset($message);
        return $messages;
    }
    
    public function getHaventReadMessageCount($to_uid){
        $where = array();
        $where['to_uid'] = $to_uid;
        $where['is_read'] = 0;
        
        return $this->where($where)->count();        
    }
    
    public function getContent($message_content_id){
        $content = S('message_content_' . $message_content_id);
        if(empty($content)){
            $content = D('MessageContent')->find($message_content_id);
            if($content){
                $content['args'] = json_decode($content['args'],true);
                $content['args_json'] = json_encode($content['args']) ;
                if($content['url']){
                    $content['web_url'] = is_bool(strpos($content['url'],'http://')) ? U($content['url'],$content['args']):$content['url'];
                }else{
                    $content['web_url'] = '';
                }               
            }
            S('message_content_' . $message_content_id, $content, 60 * 60);
        }
        
        return $content;
    }
    
    public function readMessage($message_id){
        $where = array();
        $where['message_id'] = $message_id;
        
        return  $this->where($where)->setField('is_read', 1);
    }
    
    public function setAllReaded($to_uid){
        $where = array();
        $where['to_uid'] = $to_uid;
        $where['is_read'] = 0;
        
        return $this->where($where)->setField('is_read', 1);
        
    }
}