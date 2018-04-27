<?php
namespace Common\Model;
use Think\Model;
/**
 * 配置模型
 */
class SystemConfigModel extends Model{
    /**
     * 自动验证规则
     */
    protected $_validate = array(
        array('group', 'require', '配置分组不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('type', 'require', '配置类型不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', 'require', '配置名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '1,32', '配置名称长度为1-32个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
        array('name', '', '配置名称已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('title','require','配置标题必须填写', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,32', '配置标题长度为1-32个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
        array('title', '', '配置标题已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     */
    protected $_auto = array(
        array('ctime', 'time', self::MODEL_INSERT, 'function'),
        array('utime', 'time', self::MODEL_BOTH, 'function'),
        array('status', STATUS_RESUME, self::MODEL_BOTH),
    );

    /**
     * 获取配置列表与ThinkPHP配置合并
     * @return array 配置数组
     */
    public function lists(){
        $map['status']  = array('eq', 1);
        $list = $this->where($map)->field('name,value,type')->select();
        $config = array();
        foreach ($list as $key => $val){
            switch($val['type']){
                case 'array': 
                    $config[$val['name']] = parse_attr($val['value'],1);
                    break;
                case 'checkbox': 
                    $config[$val['name']] = explode(',', $val['value']);
                    break;
                default:
                    $config[$val['name']] = $val['value'];
                    break;
            }
        }
        return $config;
    }
}
