<?php
namespace Common\Controller;
use Think\Controller;
use Common\Util\TPWechat;

class WechatController extends Controller{
    
    public $tpWechat;
    
    public function __construct(){
        $options = C('WECHAT');
        $this->tpWechat = new TPWechat($options);
        
        // 最后调用,避免引用报错
        parent::__construct();
    }
    
    public function getJsConfig(array $APIs, $debug = false, $beta = false, $json = true){
        $this->tpWechat->getJsTicket();
        $signPackage = $this->tpWechat->getJsSign($this->getCurrentUrl());
        
        $base = [
            'debug' => $debug,
            'beta' => $beta,
        ];
        
        $config = array_merge($base, $signPackage, ['jsApiList' => $APIs]);

        return $json ? json_encode($config) : $config;
    }
    
    private function getCurrentUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
            || $_SERVER['SERVER_PORT'] === 443) ? 'https://' : 'http://';
         
        return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];        
    }
}