<?php
namespace Common\Behavior;
use Think\Behavior;
defined('THINK_PATH') or exit();
/**
 * 初始化数据库配置
 */
class InitConfigBehavior extends Behavior{
    /**
     * 行为扩展的执行入口必须是run
     */
    public function run(&$content){
        //数据缓存前缀
        $controller_name = explode('/', CONTROLLER_NAME); //获取ThinkPHP控制器分级时控制器名称
        if(sizeof($controller_name) === 2){
            C('DATA_CACHE_PREFIX', ENV_PRE.'_'.MODULE_NAME.'_'.$controller_name[0].'_');
        }else{
            C('DATA_CACHE_PREFIX', ENV_PRE.'_'.MODULE_NAME.'_');
        }
        
        //读取数据库中的配置
        $system_config = S('DB_CONFIG_DATA');
        if(!$system_config || C('USE_NO_CACHE')){
            //获取所有系统配置
            $system_config = D('SystemConfig')->lists();

            //模块标记
            $system_config['MODULE_MARK'] = MODULE_NAME;
            
            //SESSION与COOKIE前缀设置避免冲突
            $system_config['SESSION_PREFIX'] = ENV_PRE.'_'.MODULE_NAME.'_'; //Session前缀
            $system_config['COOKIE_PREFIX']  = ENV_PRE.'_'.MODULE_NAME.'_'; //Cookie前缀
            
            //当前模块模版参数配置
            $system_config['TMPL_PARSE_STRING'] = C('TMPL_PARSE_STRING'); //先取出配置文件中定义的否则会被覆盖
            $system_config['TMPL_PARSE_STRING']['__CSS__']  = __ROOT__.'/Public/'.MODULE_NAME.'/css';
            $system_config['TMPL_PARSE_STRING']['__IMG__']  = __ROOT__.'/Public/'.MODULE_NAME.'/img';
            $system_config['TMPL_PARSE_STRING']['__JS__']   = __ROOT__.'/Public/'.MODULE_NAME.'/js';
            
            S('DB_CONFIG_DATA', $system_config, 3600); //缓存配置
        }

        C($system_config); //添加配置
    }
}
