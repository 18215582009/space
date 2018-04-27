<?php
function is_oauth(){
    return session('?oauth_userinfo');
}

function is_follow($member_id, $follow_member_id){
    $where['member_id']        = $member_id;
    $where['follow_member_id'] = $follow_member_id;
    
    $info = M('MemberFollow')->where($where)->find();
    return $info ? true : false;
}

function is_fav($member_id, $feed_id){
    $where['member_id'] = $member_id;
    $where['feed_id']   = $feed_id;
    
    $info = M('FeedFavorite')->where($where)->find();
    return $info ? true : false;   
}

function is_self($member_id, $to_member_id){
    return $member_id == $to_member_id ? true : false;
}

/**
 * send_comment_message 发送评论消息
 */
function send_comment_message($to_uid, $feed_id, $message){
    $title = '评论消息';
    $from_uid = is_login();
    $type = 1;
    D('Message')->sendMessage($to_uid, $title, $message, 'Feed/info', array('feed_id' => $feed_id), $from_uid, $type);
}