<?php
namespace Admin\Controller;
class IndexController extends AdminController {
    
    public function index(){
        
        $this->assign('meta_title', '后台首页');
        $this->display();
    }
    
    /**
     * 完全删除指定文件目录
     */
    public function rmdirr($dirname = RUNTIME_PATH){
        $file = new \Common\Util\File();
        $result = $file->del_dir($dirname);
        if($result){
            $this->success("缓存清理成功");
        }else{
            $this->error("缓存清理失败");
        }
    }
    
}