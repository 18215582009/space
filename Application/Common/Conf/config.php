<?php
$_config = array(
    //------TP配置------
    // 显示页面Trace信息
     'SHOW_PAGE_TRACE' => false,
    
    // 加载扩展配置文件
    'LOAD_EXT_CONFIG' => 'db_const_map,upload,route,wechat',
    
    // URL模式
    'URL_MODEL' => URL_PATHINFO,

    // URL不区分大小写
    'URL_CASE_INSENSITIVE' => false,
    
    // 应用配置
    'MODULE_DENY_LIST'   => array('Common','Runtime'),
    'MODULE_ALLOW_LIST'  => array('Home','Admin','Wap'),
    'DEFAULT_MODULE'     => 'Home',

     'URL_HTML_SUFFIX' => '', 
    
    // 模块映射的模块必须使用小写定义
    // 'URL_MODULE_MAP'     => array('mng'=>'admin'),
    
    // 模板相关配置
    'TMPL_PARSE_STRING'  => array(
        '__PUBLIC__' => __ROOT__.'/Public',
        '__LIBS__'   => __ROOT__.'/Public/Libs',
    ),    
    
    //------自定义配置------
    'WEBSITE_DOMAIN'  => 'http://www.ejar.com.cn',//官网地址
    'PRODUCT_NAME'    => 'Ejar',                  //产品名称
    'CURRENT_VERSION' => '1.0.0',                 //当前版本
    
    //系统主页地址配置
    'HOME_PAGE'    => 'http://'.$_SERVER['HTTP_HOST'].__ROOT__,
    
    // 是否禁用缓存
     'USE_NO_CACHE' => APP_DEBUG,
    
    // 系统加密盐值（轻易不要修改此项，否则容易造成用户无法登录；如要修改，务必备份原key）
    'AUTH_KEY' => 'Q[F`jk,u:jQ^<Qe-_UwyOwkIL(S~:q&aX#b%M>a}%I)?]>o?SO{ZJ`_.,SmkBTP:',
);

return array_merge(
    $_config, //系统全局默认配置
    include APP_PATH.'/Common/Conf/db.php', //包含数据库连接配置
    include APP_PATH.'/Common/Builder/config.php' //包含Builder配置      
);