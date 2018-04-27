<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
/**
 * 后台公共控制器
 */
class AdminController extends CommonController{
    
    protected function _initialize(){
        //登录检测
        if(!is_login()){ //还没登录跳转到登录页面
            $this->redirect('Admin/Public/login');
        }
        
        // 权限检测 TODO
        
        //获取系统菜单导航
        $map['status'] = array('eq', 1);
        if(!C('DEVELOP_MODE')){ //是否开启开发者模式
            $map['dev'] = array('neq', 1);
        }
        $tree = new \Common\Util\Tree();
        $all_admin_menu_list = $tree->list_to_tree(D('SystemMenu')->where($map)->select()); //所有系统菜单

        //设置数组key为菜单ID
        foreach($all_admin_menu_list as $key => $val){
            $all_menu_list[$val['id']] = $val;
        }

        $current_menu = D('SystemMenu')->getCurrentMenu(); //当前菜单
        if($current_menu){
            $parent_menu = D('SystemMenu')->getParentMenu($current_menu); //获取面包屑导航
            foreach($parent_menu as $key => $val){
                $parent_menu_id[] = $val['id'];
            }
            $side_menu_list = $all_menu_list[$parent_menu[0]['id']]['_child']; //左侧菜单
        }

        $this->assign('__ALL_MENU_LIST__', $all_menu_list); //所有菜单
        $this->assign('__SIDE_MENU_LIST__', $side_menu_list); //左侧菜单
        $this->assign('__PARENT_MENU__', $parent_menu); //当前菜单的所有父级菜单
        $this->assign('__PARENT_MENU_ID__', $parent_menu_id); //当前菜单的所有父级菜单的ID
        $this->assign('__CURRENT_ROOTMENU__', $parent_menu[0]['id']); //当前主菜单
        $this->assign('__MEMBER__', session('member_auth') ? : cookie('member_auth')); //用户登录信息
    }
}
