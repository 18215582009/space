<?php
namespace Admin\Controller;

class PublicSliderController extends AdminController{
    
    public function index($p = 1){// 默认第一页
        //搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['slider_id|slider_title'] = array($condition, $condition, '_multi'=>true);
    
        //获取所有用户
        $map['slider_status'] = array('egt', '0'); //禁用和正常状态
        $slider_model = D('PublicSlider');
        $data_list = $slider_model->page($p, C('ADMIN_PAGE_ROWS'))
                                  ->where($map)
                                  ->order('slider_sort asc, slider_id desc')
                                  ->select();
        $page = new \Common\Util\Page($slider_model->where($map)->count(), C('ADMIN_PAGE_ROWS'));
        
        //使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('轮播列表') //设置页面标题
                ->setTableDataListKey('slider_id')
                ->setTableDataListStatus('slider_status')
                ->setTableDataList($data_list) //数据列表
                ->setTableDataPage($page->show()) //数据列表分页
                ->addTopButton('addnew')  //添加新增按钮
                ->addTopButton('resume')  //添加启用按钮
                ->addTopButton('forbid')  //添加禁用按钮
                ->addTopButton('delete')  //添加删除按钮
                ->setSearch('请输入ID/标题', U('index'))
                ->addTableColumn('slider_id', 'ID')
                ->addTableColumn('slider_title', '标题')
                ->addTableColumn('slider_cover', '封面', 'picture')
                ->addTableColumn('slider_url', '链接')
                ->addTableColumn('slider_status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->addRightButton('edit')   //添加编辑按钮
                ->addRightButton('forbid') //添加禁用/启用按钮
                ->addRightButton('delete') //添加删除按钮
                ->display();
    }
    
    /**
     * 新增用户
     */
    public function add(){
        if(IS_POST){
            $slider_model = D('PublicSlider');
            $data = $slider_model->create();
            if($data){
                $id = $slider_model->add();
                if($id){
                    $this->success('新增成功', U('index'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($slider_model->getError());
            }
        }else{
            $slider_model = D('PublicSlider');
    
            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增轮播') //设置页面标题
                    ->setPostUrl(U('add')) //设置表单提交地址
                    ->addFormItem('slider_title', 'text', '标题', '标题')
                    ->addFormItem('slider_cover', 'picture', '封面', '封面')
                    ->addFormItem('slider_url', 'text', '链接', 'U函数解析的格式')
                    ->addFormItem('slider_sort', 'num', '排序', '越小越靠前')
                    ->display();
        }
    }
    
    /**
     * 编辑用户
     */
    public function edit($slider_id = 0){
        if(IS_POST){
            $slider_model = D('PublicSlider');
            $data = $slider_model->create();
            if($data){
                if($slider_model->save()!== false){
                    $this->success('更新成功', U('index'));
                }else{
                    $this->error('更新失败');
                }
            }else{
                $this->error($slider_model->getError());
            }
        }else{
            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑用户') //设置页面标题
                    ->setPostUrl(U('edit')) //设置表单提交地址
                    ->addFormItem('slider_id', 'hidden', 'ID', 'ID')
                    ->addFormItem('slider_title', 'text', '标题', '标题')
                    ->addFormItem('slider_cover', 'picture', '封面', '封面')
                    ->addFormItem('slider_url', 'text', '链接', 'U函数解析的格式')
                    ->addFormItem('slider_sort', 'num', '排序', '越小越靠前')
                    ->setFormData(D('PublicSlider')->find($slider_id))
                    ->display();
        }
    }    
}