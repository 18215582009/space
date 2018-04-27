<?php
namespace Home\Controller;
use Think\Controller;
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:*');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class CategoryController extends Controller{

     public function Index($value='')
    {
       echo "hello";
    }
     /**
     * 获取所有商家具体信息
     * POST type_id:分类id
     */
    public function get_Shoplist()
    {
        $shop_model = D('Shop');
        if(IS_POST){
            $where['status'] = 1;
            $id = I('type_id');
            if(!$id || $id ==""){
                $data = $shop_model->field("shop.*,category.cat_name")->join("left join category on shop.type_id = category.cat_id ")->where($where)->select();
            }else{
                $where['type_id'] = $id;
                $data = $shop_model->field("shop.*,category.cat_name")->join("left join category on shop.type_id = category.cat_id ")->where($where)->select();
            }
            $rs =  array();
            foreach ($data as $key => $value) {
                 $rs[$key] = $value;
                 isset($value['sign']) ? $sign= explode(",", $value['sign']):$sign="";
                 $rs[$key]['sign'] = $sign;
                 isset($value['sign_build']) ?$build = explode(',', $value['sign_build']):$build="";
                 $rs[$key]['sign_build'] = $build;
                 $rs[$key]['bs_start_time'] = $value['bs_start_time'];
                 $rs[$key]['bs_end_time'] = $value['bs_end_time'];
            }
           if(!empty( $rs )){
                $result = array('status'=>200,'data'=>$rs, 'info'=>'Success');
           }else{
                $result = array( 'status'=>404, 'data'=>null, 'info'=>'Faild');
           }
           $this->ajaxReturn($result);
        }else{
            $this->error("提交方式出错");
        }
    }

    /**
     * 获取所有分类
     * POST
     */
    public function get_Category()
    {
        $shop_model = D('Category');
        if(IS_POST){
            $where['is_show'] = 1;
            $data = $shop_model->where($where)->select();
            if(!empty($data)){
                 $result = array('status'=>200,'data'=>$data, 'info'=>'Success');
            }else{
                $result = array( 'status'=>404, 'data'=>null, 'info'=>'Faild');
            }
            $this->ajaxReturn($result);
        }else{
            $this->error("提交错误");
        }
    }

    /**
     * 获取店铺具体信息
     * POST
     */

    public function get_Shopinfo($Id='')
    {
        # code...
         $shop_model = D('Shop');
         if(IS_POST){
            $where['id'] = I('id');
            $where['status'] = 1;
            $rs = array();
            $data = $shop_model->field("shop.*,category.cat_name")->join("left join category on shop.type_id = category.cat_id ")->where($where)->find();
            $rs['cat_name'] = $data['cat_name'];
            $rs["id"] = $data['id'];
            $rs["shop_name"] = $data['shop_name'];
            $rs["type_id"] = $data['type_id'];
            $rs["rank_id"] = $data['rank_id'];
            $rs["coutry"] = $data['coutry'];
            $rs["province"] = $data['province'];
            $rs["ciry"] = $data['ciry'];
            $rs["district"] = $data['district'];
            $rs["address"] = $data['address'];
            $rs["tel"] = $data['tel'];
            $rs["status"] = $data['status'];
            $rs["shop_img"] = $data['shop_img'];
            $rs["latitude"] = $data['latitude'];
            $rs["longitude"] = $data['longitude'];
            $rs["qr_code"] = $data['qr_code'];
            $rs["untoken"] = $data['untoken'];
            $rs["desc"] = $data['desc'];
            isset($data['sign']) ? $sign= explode(",", $data['sign']):$sign="";
             $rs['sign'] = $sign;
            isset($data['sign_build']) ?$build = explode(',', $data['sign_build']):$build="";
            $rs['sign_build'] = $build;
            $rs['bs_start_time'] = $data['bs_start_time'];
            $rs['bs_end_time'] = $data['bs_end_time'];
            if(!empty($rs)){
                $result = array('status'=>200,'data'=>$rs, 'info'=>'Success');
                $this->ajaxReturn($result);
            }else{
                $result = array('status'=>404,'data'=>null, 'info'=>'Faild');
                $this->ajaxReturn($result);
            }
         }else{
            $this->error("提交方式错误");
         }
    }






}
