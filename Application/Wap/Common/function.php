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

// 判断是否是在微信浏览器里
function is_wechatBrowser() {
    $agent = $_SERVER ['HTTP_USER_AGENT'];
    if (! strpos ( $agent, "icroMessenger" )) {
        return false;
    }
    return true;
}

function send_template_message($data){
    $options = C('WECHAT');
    
    $wechat = new \Common\Util\TPWechat($options);
    
    return $wechat->sendTemplateMessage($data);
}