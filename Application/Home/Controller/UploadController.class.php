<?php
namespace Home\Controller;
class UploadController extends HomeController{
    
    public function post(){
        if(!IS_POST){
            $this->error('请使用post提交');
        }
        
        dump($_FILES);
        dump($_POST);
        
        $this->success('上传成功');
    }
    
    public function get(){
        if(!IS_GET){
            $this->error('请使用get提交');
        }
    }
    
    public function delete(){
        if(!IS_DELETE){
            $this->error('请使用delete提交');
        }
    }
}