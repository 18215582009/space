<?php
namespace Common\Model;
use Think\Model;
class PublicSliderModel extends Model{
    /**
     * 自动验证规则
     */
    protected $_validate = array(
        array('slider_cover', 'require', '封面不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );
    
    /**
     * 自动完成规则
    */
    protected $_auto = array(
        array('slider_ctime', NOW_TIME, self::MODEL_INSERT),
        array('slider_utime', NOW_TIME, self::MODEL_BOTH),
        array('slider_status', STATUS_RESUME, self::MODEL_INSERT),
    );
}