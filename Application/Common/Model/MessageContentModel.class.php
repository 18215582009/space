<?php
namespace Common\Model;
use Think\Model;
class MessageContentModel extends Model{
    
    protected function _before_insert(&$data, $options){
        $data['content'] = json_encode($data['content']);
    }
    
    protected function _after_find(&$result, $options){
        $result['content'] = json_decode($result['content']);
    }
    
    protected function _after_select(&$resultSet, $options){
        foreach ($resultSet as &$result){
            $this->_after_find($result, $options);
        }
    }
}