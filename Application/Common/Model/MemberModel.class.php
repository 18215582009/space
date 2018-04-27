<?php
namespace Common\Model;
use Think\Model;
class MemberModel extends Model{
    /**
     * 修改密码
     */
    const MODEL_EDIT_PASS  = 5;
    /**
     * 手机号注册
     */
    const MODEL_MOBILE_REG = 6;
    /**
     * 微信注册
     */
    const MODEL_WECHAT_REG = 7;
    
    /**
     * 自动验证规则
     */
    protected $_validate = array(
        //验证用户名
        array('member_name', '3,32', '用户名长度为1-32个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
        array('member_name', '', '用户名被占用', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
        array('member_name', 'checkIP', '注册太频繁请稍后再试', self::MUST_VALIDATE, 'callback', self::MODEL_INSERT), //IP限制
        array('member_name', 'checkUsername', '该用户名禁止使用', self::MUST_VALIDATE, 'callback', self::MODEL_BOTH), //用户名敏感词检测
        array('member_name', '/^(?!_)(?!\d)(?!.*?_$)[\w\一-\龥]+$/', '用户名只可含有汉字、数字、字母、下划线且不以下划线开头结尾，不以数字开头！', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        //验证手机号码
        array('member_mobile', '/^1\d{10}$/', '手机号码格式不正确', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('member_mobile', '', '手机号被占用', self::EXISTS_VALIDATE, 'unique', self::MODEL_BOTH),
        //验证邮箱
        array('member_email', 'email', '邮箱格式不正确', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('member_email', '', '邮箱被占用', self::EXISTS_VALIDATE, 'unique', self::MODEL_BOTH),    
        
        //验证密码
        array('member_password', '6,30', '密码长度为6-30位', self::MUST_VALIDATE, 'length', self::MODEL_INSERT),
        array('member_password', '/(?!^(\d+|[a-zA-Z]+|[~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+)$)^[\w~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+$/', '密码至少由数字、字符、特殊字符三种中的两种组成', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('repeat_password', 'password', '两次输入的密码不一致', self::EXISTS_VALIDATE, 'confirm', self::MODEL_INSERT),
    
        array('member_gender', '/^(0|1|2){1}$/', '请选择性别', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('member_avatar', 'number', '请上传头像', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    
        //重置密码时自动验证规则
        array('member_password', '6,30', '密码长度为6-30位', self::EXISTS_VALIDATE, 'length', self::MODEL_EDIT_PASS),
        array('member_password', '/(?!^(\d+|[a-zA-Z]+|[~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+)$)^[\w~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+$/', '密码至少由数字、字符、特殊字符三种中的两种组成', self::EXISTS_VALIDATE, 'regex', self::MODEL_EDIT_PASS),
    
        // 手机号注册
        array('member_mobile', '/^1\d{10}$/', '手机号码格式不正确', self::MUST_VALIDATE, 'regex', self::MODEL_MOBILE_REG),
        array('member_mobile', '', '手机号被占用', self::MUST_VALIDATE, 'unique', self::MODEL_MOBILE_REG), 
        
        // 微信号注册
        array('member_name', 'require', '用户名必须', self::MUST_VALIDATE, 'regex', self::MODEL_WECHAT_REG),
        array('member_name', '', '用户名被占用', self::MUST_VALIDATE, 'unique', self::MODEL_WECHAT_REG),     

        array('member_gender', '/^(0|1|2){1}$/', '请选择性别', self::EXISTS_VALIDATE, 'regex', self::MODEL_WECHAT_REG),
    );
    
    /**
     * 自动完成规则
     * @author jry <598821125@qq.com>
    */
    protected $_auto = array(
        // 新增时写入
        array('member_password', 'member_md5', self::MODEL_INSERT, 'function'),
        array('member_reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('member_reg_time', NOW_TIME, self::MODEL_INSERT),
        array('member_status', STATUS_RESUME, self::MODEL_INSERT),
        
        // 更新时为空则忽略
         array('member_name', '', self::MODEL_UPDATE, 'ignore'),
        array('member_mobile', '', self::MODEL_UPDATE, 'ignore'),
        array('member_email', '', self::MODEL_UPDATE, 'ignore'),
        array('member_password', '', self::MODEL_UPDATE, 'ignore'),
    
        //重置密码时自动完成规则
        array('member_password', 'member_md5', self::MODEL_EDIT_PASS, 'function'),
        
        //手机号注册时自动完成规则
        array('member_reg_ip', 'get_client_ip', self::MODEL_MOBILE_REG, 'function', 1),
        array('member_reg_time', NOW_TIME, self::MODEL_MOBILE_REG),
        array('member_status', STATUS_RESUME, self::MODEL_MOBILE_REG),
        
        //微信号
        array('member_reg_ip', 'get_client_ip', self::MODEL_WECHAT_REG, 'function', 1),
        array('member_reg_time', NOW_TIME, self::MODEL_WECHAT_REG),
        array('member_status', STATUS_RESUME, self::MODEL_WECHAT_REG),        
    );    
    
    /**
     * 检测同一IP注册是否频繁
     * @return boolean ture 正常，false 频繁注册
     */
    protected function checkIP(){
        $limit_time = C('LIMIT_TIME_BY_IP');
        $map['member_reg_time'] = array('GT', time()-(int)$limit_time);
        $reg_ip = $this->where($map)->getField('member_reg_ip', true);
        $key = array_search(get_client_ip(1), $reg_ip);
        if($reg_ip && $key !== false){
            return false;
        }
        return true;
    }
    
    /**
     * 用户名敏感词检测
     * @return boolean ture 正常，false 敏感词
     */
    protected function checkUsername(){
        $deny = explode(',', C('SENSITIVE_WORDS'));
        foreach($deny as $k=> $v){
            if(stristr(I('post.member_name'), $v)){
                return false;
            }
        }
        return true;
    }    
    
    /**
     * 用户性别(DB映射关系)
     * @param string $id
     * @return Ambigous <multitype:string , string>
     */
    public function getGender($id = null){
        $list = array();
        $list[0] = '保密';
        $list[1] = '男';
        $list[2] = '女';
        return $id === null ? $list : $list[(int)$id];
    }
    
    /**
     * 用户名,密码登陆
     * @param string $username
     * @param string $password
     * @param array $map
     */
    public function login($username, $password, $map = array()){
        // 去除前后空格
        $username = trim($username);
        
        $map['member_name']   = array('eq', $username); 
        $map['member_status'] = array('eq', STATUS_RESUME);
        
        $member_info = $this->where($map)->find();
        if(!$member_info){
            $this->error = '登录失败,用户不存在或被禁用';
        }else{
            if(member_md5($password) !== $member_info['member_password']){
                $this->error = '密码错误';
            }else{
                // 更新登录信息
                $data = array(
                    'member_id'              => $member_info['member_id'],
                    'member_login_num'       => array('exp', '`member_login_num`+1'),
                    'member_last_login_time' => NOW_TIME,
                    'member_last_login_ip'   => get_client_ip(1),
                );
                $this->save($data);
                $this->autoLogin($member_info, I('post.remember'));
                return $member_info['member_id'];
            }
        }
        return false;
    }
    
    /**
     * 手机号登录
     * @param string $mobile
     */
    public function mobileLogin($mobile){
        // 去除前后空格
        $mobile = trim($mobile);
        
        $where['member_mobile'] = $mobile;
        $where['member_status'] = array('eq', STATUS_RESUME);
        
        $member_info = $this->where($where)->find();
        if(!$member_info){
            $this->error = '登录失败,该手机号未被注册';
        }else{
            // 更新登录信息
            $data = array(
                'member_id'              => $member_info['member_id'],
                'member_login_num'       => array('exp', '`member_login_num`+1'),
                'member_last_login_time' => NOW_TIME,
                'member_last_login_ip'   => get_client_ip(1),
            );
            $this->save($data);
            $this->autoLogin($member_info, I('post.remember'));
            return $member_info['member_id'];            
        }
        return false;
    }
    
    /**
     * 微信号登录
     * @param array $userinfo
     */
    public function wechatLogin($userinfo, $isAdmin = false, $where = array()){
        if(empty($userinfo) || !is_array($userinfo)){
            $this->error = '错误的授权信息';
            return false;
        }
        
        $where['openid'] = $userinfo['openid'];
        
        $memberWecaht_model = D('MemberWechat');
        $memberWecaht_info = $memberWecaht_model->where($where)->find();
        if(!$memberWecaht_info){
            $this->error = '登录失败,该微信号未绑定';
            return false;
        }
        $where = array();
        $where['member_id'] = $memberWecaht_info['member_id'];
        $where['member_status'] = array('eq', STATUS_RESUME);
        
        $member_info = $this->where($where)->find();
        if(!$member_info){
            $this->error = '登录失败,用户不存在或被禁用';
            return false;
        }
        
        if($isAdmin){
            if($member_info['group_id'] == 0){
                $this->error = '权限不足';
                return false;
            } 
        }
        
        // 更新登录信息
        $data = array(
            'member_id'              => $member_info['member_id'],
            'member_login_num'       => array('exp', '`member_login_num`+1'),
            'member_last_login_time' => NOW_TIME,
            'member_last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);
        $this->autoLogin($member_info, I('post.remember'));
        return $member_info['member_id'];            
    }
    
    public function autoLogin($member_info, $remember){
        // 记录登录SESSION和COOKIES
        $auth = array(
            'mid'              => $member_info['member_id'],
            'name'             => $member_info['member_name'],
            'avatar'           => $member_info['member_avatar'],
            'last_login_time'  => $member_info['member_last_login_time'],
            'last_login_ip'    => $member_info['member_last_login_ip'], 
        );
        session('member_auth', $auth);
        session('member_auth_sign', $this->dataAuthSign($auth));
        if($remember){
            cookie('member_auth', $auth, 7*24*60*60);
            cookie('member_auth_sign', $this->dataAuthSign($auth), 7*24*60*60);
        }
    }
    
    public function dataAuthSign($data){
        // 数据类型检测
        if(!is_array($data)){
            $data = (array)$data;
        }
        ksort($data);// 排序
        $code = http_build_query($data);// url编码并生成query字符串
        $sign = sha1($code);// 生成签名
        return $sign;    
    }
    
    public function isLogin(){
        $member = session('member_auth') ? : cookie('member_auth');
        $member_auth_sign = session('member_auth_sign') ? : cookie('member_auth_sign');
        if(empty($member)){
            return 0;
        }else{
            return $member_auth_sign == $this->dataAuthSign($member) ? $member['mid'] : 0;
        }
    }
}