<?php
namespace Common\Controller;
use Think\Controller;
/**
 * 所有模块公共控制器
 */
class CommonController extends Controller{
    /**
     * 设置一条或者多条数据的状态
     */
    public function setStatus($model = CONTROLLER_NAME){
        $ids    = I('request.ids');
        $status = I('request.status');
        $field  = I('request.field');
        
        if(empty($ids)){
            $this->error('请选择要操作的数据');
        }
        //特殊情况处理
        switch($model){
            case 'Member':
                if(in_array(ADMINISTRATORS, $ids, true) || ADMINISTRATORS == $ids)
                    $this->error('不允许更改超级管理员状态');
                break;
            default:
                break;
        }
        $model_primary_key = D($model)->getPk();
        $map[$model_primary_key] = array('in',$ids);
        switch($status){
            case 'forbid' : //禁用条目
                $data = array($field => 0);
                $this->editRow($model, $data, $map, array('success'=>'禁用成功','error'=>'禁用失败'));
                break;
            case 'resume' : //启用条目
                $data = array($field => 1);
                $map  = array_merge(array($field => 0), $map);
                $this->editRow($model, $data, $map, array('success'=>'启用成功','error'=>'启用失败'));
                break;
            case 'hide' : //隐藏条目
                $data = array($field => 2);
                $map  = array_merge(array($field => 1), $map);
                $this->editRow($model, $data, $map, array('success'=>'隐藏成功','error'=>'隐藏失败'));
                break;
            case 'show' : //显示条目
                $data = array($field => 1);
                $map  = array_merge(array($field => 2), $map);
                $this->editRow($model, $data, $map, array('success'=>'显示成功','error'=>'显示失败'));
                break;
            case 'recycle' : //移动至回收站
                $data[$field] = -1;
                $this->editRow($model, $data, $map, array('success'=>'成功移至回收站','error'=>'删除失败'));
                break;
            case 'restore' : //从回收站还原
                $data = array($field => 1);
                $map  = array_merge(array($field => -1), $map);
                $this->editRow($model, $data, $map, array('success'=>'恢复成功','error'=>'恢复失败'));
                break;
            case 'delete'  : //删除条目
                $result = D($model)->where($map)->delete();
                if($result){
                    $this->success('删除成功，不可恢复！');
                }else{
                    $this->error('删除失败');
                }
                break;
            default :
                $this->error('参数错误');
                break;
        }
    }

    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $data  修改的数据
     * @param array  $map   查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                      url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     */
    final protected function editRow($model, $data, $map, $msg){
        $msg = array_merge(array('success'=>'操作成功！', 'error'=>'操作失败！', 'url'=>'' ,'ajax'=>IS_AJAX) , (array)$msg);
        if(M($model)->where($map)->save($data) !== false){
            $this->success($msg['success'], $msg['url'], $msg['ajax']);
        }else{
            $this->error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }
}
