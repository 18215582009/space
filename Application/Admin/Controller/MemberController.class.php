<?php
namespace Admin\Controller;
class MemberController extends AdminController {

    public function index($p = 1){// 默认第一页
        //搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['member_id|member_name|member_mobile'] = array($condition, $condition, $condition,'_multi'=>true);

        //获取所有用户
        $map['member_status'] = array('egt', '0'); //禁用和正常状态
        $member_model = D('Member');
        $data_list = $member_model->page($p, C('ADMIN_PAGE_ROWS'))
                                  ->where($map)
                                  ->order('member_id desc')
                                  ->select();
        //循环获取分享次数当前宝箱类型
        foreach ($data_list as $key=>$value){
            $data_list[$key] = $value;
            $count= M('Feed')->field('count(feed_id)')->where('member_id = '.$value['member_id'])->select();
            $data_list[$key]['count'] = $count[0]['count(feed_id)'];
            $data_list[$key]['box'] = $this->back_BoxType($data_list[$key]['count']);
        }

        $page = new \Common\Util\Page($member_model->where($map)->count(), C('ADMIN_PAGE_ROWS'));

        foreach ($data_list as &$info){
            if($info['group_id'] > 0){
                $info['member_group'] = '<label class="label label-info">系统管理员</label>';
            }else{
                $info['member_group'] = '<label class="label label-default">普通会员</label>';
            }
        }

        $top_btn = array();
        $top_btn['title'] = '设为管理员';
        $top_btn['href']  = U('Member/groupAdd');
        $top_btn['class'] = 'btn btn-info ajax-post confirm';

        $top2_btn = array();
        $top2_btn['title'] = '取消管理员';
        $top2_btn['href']  = U('Member/groupDel');
        $top2_btn['class'] = 'btn btn-default ajax-post confirm';

        //使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('用户列表') //设置页面标题
                ->setTableDataListKey('member_id')
                ->setTableDataListStatus('member_status')
                ->setTableDataList($data_list) //数据列表
                ->setTableDataPage($page->show()) //数据列表分页
                ->addTopButton('addnew')  //添加新增按钮
                ->addTopButton('resume')  //添加启用按钮
                ->addTopButton('forbid')  //添加禁用按钮
                ->addTopButton('delete')  //添加删除按钮
                ->addTopButton('self', $top_btn)
                ->addTopButton('self', $top2_btn)
                ->setSearch('请输入ID/用户名/手机号', U('index'))
                ->addTableColumn('member_id', 'MID')
                ->addTableColumn('member_name', '微信昵称')
                ->addTableColumn('member_mobile', '手机号')
                ->addTableColumn('member_last_login_time', '最后登录时间时间', 'time')
                ->addTableColumn('count', '分享次数')
                ->addTableColumn('box', '已开宝箱')
                ->addTableColumn('member_group', '是否管理员')
                ->addTableColumn('member_status', '状态', 'status')
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
            $member_model = D('Member');
            $data = $member_model->create();
            if($data){
                $id = $member_model->add();
                if($id){
                    $this->success('新增成功', U('index'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($member_model->getError());
            }
        }else{
            $member_model = D('Member');

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增用户') //设置页面标题
                    ->setPostUrl(U('add')) //设置表单提交地址
                    ->addFormItem('member_name', 'text', '用户名', '用户名')
                    ->addFormItem('member_mobile', 'num', '手机号码', '手机号码')
                    ->addFormItem('member_password', 'text', '密码', '密码')
                    ->addFormItem('member_real_name', 'text', '真实姓名', '真实姓名')
                    ->addFormItem('member_avatar', 'picture', '用户头像', '用户头像')
                    ->addFormItem('member_gender', 'radio', '性别', '性别', $member_model->getGender())
                    ->setFormData(array('member_avatar'=>'0'))
                    ->display();
        }
    }

    /**
     * 编辑用户
     */
    public function edit($member_id){
        //获取用户信息
        $info = D('Member')->find($member_id);

        if(IS_POST){
            $member_model = D('Member');
            //不修改密码时销毁变量
            if($_POST['member_password'] == '' || $info['member_password'] == $_POST['member_password']){
                unset($_POST['member_password']);
            }else{
                $_POST['member_password'] = member_md5($_POST['member_password']);
            }
            //不允许更改超级管理员用户组 TODO

            if($member_model->save($_POST)){
                $this->success('更新成功', U('index'));
            }else{
                $this->error('更新失败', $member_model->getError());
            }
        }else{
            $member_model = D('Member');
            $info = $member_model->find($member_id);
            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑用户') //设置页面标题
                    ->setPostUrl(U('edit')) //设置表单提交地址
                    ->addFormItem('member_id', 'hidden', 'ID', 'ID')
                    ->addFormItem('member_name', 'text', '用户名', '用户名')
                    ->addFormItem('member_mobile', 'text', '手机号码', '手机号码')
                    ->addFormItem('member_password', 'password', '密码', '密码')
                    ->addFormItem('member_real_name', 'text', '真是姓名', '真实姓名')
                    ->addFormItem('member_avatar', 'picture', '用户头像', '用户头像')
                    ->addFormItem('member_gender', 'radio', '性别', '性别', $member_model->getGender())
                    ->setFormData($info)
                    ->display();
        }
    }

    public function groupAdd(){
        $ids = I('ids');

        $data = array();
        $data['group_id'] = 1;

        $where = array();
        $where['member_id'] = array('in', array_unique($ids));

        $member_model = D('Member');
        $result = $member_model->where($where)->save($data);

        if($result != false){
            $this->success('操作成功', U('index'));
        }else{
            $this->error('操作失败');
        }
    }

    public function groupDel(){
        $ids = I('ids');

        $data = array();
        $data['group_id'] = 0;

        $where = array();
        $where['member_id'] = array('in', array_unique($ids));

        $member_model = D('Member');
        $result = $member_model->where($where)->save($data);

        if($result != false){
            $this->success('操作成功', U('index'));
        }else{
            $this->error('操作失败');
        }
    }


    /**
     * 返回宝箱类型--by xiewen
     *
     * @var object
     * @access mysql
     * @fun  back_BoxType
     * @param $count 分享次数
     * @param
     */
    public  function  back_BoxType($count){
        if($count <= 5 ){
            $box_type = '青铜宝箱';
        }
        if(5<$count  and  $count<=10){
            $box_type = '白银宝箱';
        }
        if(10<$count and $count<=20 ){
            $box_type = '黄金宝箱';
        }
        if(20 <$count and $count<= 40){
            $box_type = '铂金宝箱';
        }
        if(40 <$count and $count<= 70){
            $box_type = '钻石宝箱';
        }
        return $box_type;

    }


}
