<?php
namespace Common\Behavior;
use Think\Behavior;
defined('THINK_PATH') or exit();
/**
 * 初始化允许访问模块信息
 */
class InitModuleBehavior extends Behavior{
    /**
     * 行为扩展的执行入口必须是run
     */
    public function run(&$content){
        // 加载数据库模块 TODO
        
        //URL_MODEL必须在app_init阶段就从数据库读取出来应用，不然系统就会读取config.php中的配置导致后台的配置失效
        $value = D('SystemConfig')->getFieldByName('URL_MODEL', 'value');
        $value && $config['URL_MODEL'] = $value;
        C($config);
    }
}
