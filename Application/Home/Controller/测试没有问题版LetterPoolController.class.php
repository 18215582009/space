<?php 
namespace Home\Controller;
use Think\Controller;
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:*');  
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("content-type:application/json");

class LetterPoolController  extends  HomeController{
		private $memb_id;
		private $shopid;
		public function __construct()
				{
					$this->memb_id=session('member_auth.mid');
					if(empty($this->memb_id)){
						$this->memb_id=1;
					}
					$this->shopid=I('shop_id');
				}

/*-----------------入口接口 包含检测用户抽奖次数 返回已抽奖的奖券-----------------------*/
		public function Index(){
			// if(empty($this->shopid)||empty($this->memb_id)){
			// 		$arrayName = array('status' =>201 ,'content'=>'没有商铺号或用户账号无法抽奖！' );
			// 		echo json_encode($arrayName);
			// 		exit;
			//  }
			$prizeIndex = $this->laravelcache(false);
			if(!empty($this->shopid)){
				$arrayName = array('status'=>0 );
				$result=$arrayName;
				if($prizeIndex>=1){
					$arrayName = array('status'=>1 );
					$result=$arrayName;
						// $reslottery = M('lotteryf_role')->query("select 	
						// 	lyf.only_key,l.start_time,l.end_time,lb.name,lb.content,lb.explain from
						// 	lotteryf_role as lyf 
						// 	join lottery_base as lb on lyf.l_id=lb.id
						// 	join lottery as l on l.l_id=lb.id and l.c_id=0
						// 	where  lyf.menid=".$this->memb_id);
						// if(!empty($reslottery)){
						// 	$res['lottery']=$reslottery[0];
						// 		}else{
						// 			$arrayName = array('status'=>1 );
						// 			$res['lottery']=$arrayName;
						// 	}
				}
							$sqlon = "on gy.id= ".$this->shopid;
			}

/*------抽奖入口获取用户 抽奖次数，分享次数,开宝箱个数,商户名-----------*/
			$res=Array();
			$res = M('lottery_joinrole')->where('memb_id='.$this->memb_id)->select();
			if(empty($res)){
				$RoleInfo=M('member')->query("select mb.feed_count,gy.title 
					    from member as mb
					    join gy_document as gy ".$sqlon."
					    where mb.member_id=".$this->memb_id."");
			}else{
					$RoleInfo=M('lottery_joinrole')->query("select mb.feed_count,gy.title,lt.chest_id 
					    from lottery_joinrole as lt
					    join member as mb on lt.memb_id= mb.member_id
					    join gy_document as gy ".$sqlon." 
					    where lt.memb_id=".$this->memb_id."");

			}
			foreach ($RoleInfo as $key => $value) {
						// $res[$key]['prize_num']=$value['td_joinnum'];
						$res['chest_id']=$value['chest_id'];
						$res['shopName']=$value['title'];
						$res['feed_count']=$value['feed_count'];
					}
			$arrayName = array('data' =>$res ,'lottery'=>$result,'status'=>200);
			echo json_encode($arrayName);exit;
		}

/*-------------------------抽奖获取奖券--------------------------------*/
		public function DrawforPrize(){
			$prizeIndex = $this->laravelcache(false);
			if($prizeIndex>=1){
				echo json_encode(array("status"=>200,"content"=>"今天抽奖次数已满"));
				exit;
			}
		 /*获得正在开奖奖池->抽奖奖券*/
		$time = time();
    	$memb_info =  M('lottery')->query("select l.id as lottery_id, l.*,lb.*,	lp.publish_total,lp.id,lp.still_stock,lp.doprize_num,lp.win_prize_num from 
					lottery as l 
					join lottery_pool as lp on lp.id=l.lp_id  
					join lottery_base as lb on l.l_id = lb.id   
    				where l.c_id=0 and lp.start_time <$time and $time < lp.end_time");
    			if(empty($memb_info)){
    				$arrayName = array('status' =>201,'content'=>'奖池暂无活动');
    				echo json_encode($arrayName);exit;
    			};
    			$result = $this->randomProduct($memb_info);
    			$res = json_encode($result);
				echo $res;exit;
		}
/*------------------------------已关注用户点击宝箱--————————————————————————————*/
		public function Treasure(){
				$ctype =  I('type',0);
				if(empty($this->memb_id)){
					$this->memb_id=1;
				}
				$cshare= M('member')->where('member_id='.$this->memb_id)->field('feed_count')->select();
				$res = M('lottery_chest')->where("c_id = $ctype")->field('share_fq')->select();
				$res = $res[0]['share_fq'];
					if(!($cshare[0]['feed_count']>=$res)){
						$arrayName = array('status' =>202,'content'=>'未达到分享次数');
    					echo json_encode($arrayName);exit;
					}else{
						$memb_info =  M('lottery')->query("select 
							l.id as lottery_id,lc.c_id as chest_id,l.*,lb.* 
							from lottery as l 
							join lottery_base as lb 
							join lotteryp_c_link as lc on lb.id = l.l_id and lc.c_id = l.c_id and lc.l_id = l.l_id
							where lc.c_id=$ctype");
						/* randomProduct 传入 商品信息 随机抽取奖品*/
						$result = $this->randomProduct($memb_info);
						echo json_encode($result);exit;
					}

		}

		//用户获取的奖券数据   meid
		public function LotteryData(){
				// 使用状态
				$status = I('use',0,'int');
				if(empty($this->memb_id)){
					$arrayName = array('status' =>200,'content'=>'用户id不存在' );
					echo json_encode($arrayName);
				}
				if($status>=0){
					$time=time();
					if($status===2){
							$sqlwhere = "where l.end_time<$time";
					}else if($status===1){
						$sqlwhere = "where lyf.status=".$status;
					}else if($status===0){
						$sqlwhere = "where lyf.status=".$status." and l.start_time<$time and $time < l.end_time";
					}
				}else{
						$arrayName = array('status' =>201 ,'content'=>'未传入type值' );
							echo json_encode($arrayName);
							exit;
					}
				$res = M('lottery_base')->query("select lyf.usetime,lyf.only_key,lyf.status,lb.shop_id,lb.name,lb.content,lb.explain,l.start_time,l.end_time,gy.title from lotteryf_role as lyf join lottery as l on l.id = lyf.l_id join lottery_base as lb on l.l_id=lb.id join gy_document as gy on gy.id = lb.shop_id ".$sqlwhere." and lyf.menid =".$this->memb_id);
				/*未使用*/
				/*已使用*/
				/*已过期*/

				$result = Array();
				foreach ($res as $key => $value) {
						$result['data'][$key]['shop_id'] =  $value['shop_id'];
						$result['data'][$key]['title'] =  $value['title'];
						$result['data'][$key]['name'] =  $value['name'];
						$result['data'][$key]['explain'] =  $value['explain'];
						$result['data'][$key]['usetime'] =  $value['usetime'];
						// $result['data'][$key]['untoken'] =  $value['untoken'
						$result['data'][$key]['content'] =  $value['content'];
						$result['data'][$key]['onlykey'] = $this->encrypt($value['only_key'],126);
						$result['data'][$key]['start_time'] =  $value['start_time'];
						$result['data'][$key]['end_time'] =  $value['end_time'];
						$result['status'] = 200;
						$result['use'] = ($status===2) ? 2 : $value['status'];
						
				}
				if(!!empty($res)){
					$arrayName = array('status' =>201,'content'=>'没有奖券');
    				echo json_encode($arrayName);exit;
				}
				echo json_encode($result);exit;
		}

/*展示二维码 跳转商户核销页面3、核销用户商券*///展示微信二维码only_key\shop_key
		public function showLotteryForPicture(){
			$onlykey=I('only_key');
			$shopkey=I('shop_key');
			$this->product_qrcode($onlykey,$shopkey);
			exit;
		}
/*核销商户优惠券*/
		public function LotterySellerData(){
				$lottery=I('lotterykey');
				$shop_id=I('shopkey');
				$delshopkey=$this->decrypt($lottery,126);
$this->redirect("Index/checkcommand?lottery=$lottery&shop_id=$shop_id&delkey=$delshopkey");
				exit;
		}
		public function destoryLottery(){
			$onlykey = I('only_key',null);
			$shopkey = I('shop_key',null);
			$shoptoken = I('shop_token',null);
			$onlykey = $this->decrypt($onlykey,126);
			if(empty($onlykey)||empty($shopkey)||empty($shoptoken)){
				echo '{"status":"201","content":"无法获取商户key！"}';
				exit;
			}
	  	$res = M('lotteryf_role')->where("only_key='".$onlykey."'")->field('status')-> select();
	  	$res = $res[0]['status'];
	  	if(intval($res)!==0){
	  			echo '{"status":"201","content":"奖券已经使用！"}';
	  			exit;
	  	};
		$shopid=M('gy_document_article')->where("untoken='".$shoptoken."'")->field('id')->select();
		$shopid=$shopid[0]['id'];
		if($shopid!==$shopkey){
			echo '{"status":"201","content":"商户口令不对！"}';
			exit;
		}
			$res = M('lottery_base')->query("select lb.name,lb.content,lb.explain,l.start_time,l.end_time,lyf.only_key,
				gy.title from
				 lottery_base as lb 
				 join lottery  as l on lb.id = l.l_id
				 join lotteryf_role as lyf on  lyf.l_id = l.id
				 join gy_document as gy on lb.shop_id=gy.id
				 where lb.shop_id=$shopid and lyf.only_key='".$onlykey."'");
			if($res[0]['only_key'] !== $onlykey){
				echo '{"status":"201","content":"该优惠券不属于该商户无法核销！"}';
				exit;
			}
			$result = Array();
			foreach ($res as $key => $value) {
					$result[$key]['title'] = $value['title'];
					$result[$key]['name'] =  $value['name'];
					$result[$key]['content'] =  $value['content'];
					$result[$key]['explain'] =  $value['explain'];
					$result[$key]['start_time'] =  $value['start_time'];
					$result[$key]['end_time'] =  $value['end_time'];
			}
			$arrayName = array('status' =>1,'usetime'=>time());
			$dblottery = M('lotteryf_role');
			try{
				$dblottery->startTrans();
				$res = $dblottery->where("only_key= '".$onlykey."'")->save($arrayName);
			}catch (\Exception $e) {
			  	$dblottery->rollback();
			       	echo json_encode(array('status'=>203,'content'=>"服务器繁忙未能销毁奖券请重新销毁！".($e->getMessage())));
			       	exit;
    			}
    			$dblottery->commit();

			if($res>0){
				echo '{"status":"200","content":"更新成功！"}';
				exit;
			}else{
				$arrayName = array('status' => 201 ,'content'=>$res);
				echo json_encode($arrayName);
			}

		}
/*商户展示已核销的奖券*/
		public function ShopDesLotteryInfo(){
			$shop_token = I("shop_token");
			if(empty($shop_token)){
				echo json_encode(array('status'=>200,'content'=>'没有商户令牌号'));
				exit;
			}

			$res = M('gy_document')->query("select gy.id from gy_document as gy
				join gy_document_article as gyd on gyd.id = gy.id
 				where gyd.untoken='".$shop_token."'");
			if(empty($res)){
				echo json_encode(array("data"=>'口令未匹配商户号','status'=>201));
				exit;
			}else{
				$arrayName = array('shop_id' =>$res[0]['id']);
				echo json_encode(array("data"=>$arrayName,'status'=>200));
				exit;
			}
				
	}


/*商户获取已经使用奖券的数据*/
		public function shopCancelLottery(){
							$shopid=I('shop_id');
							if(empty($shopid)){
								$arrayName = array('status' =>201 ,'conentent'=>'没有商户号' );
								echo json_encode($arrayName);
								exit;
							}
							$res = M('lottery_base')->query("select 
								l.start_time,l.end_time,gy.title,lyf.usetime,
							lb.name,lb.content,lb.explain,mb.member_name,mw.headimgurl
							 from lottery_base as lb
								join lottery as l on lb.id=l.l_id 
								join lotteryf_role as lyf on lyf.l_id=l.id
								join member as mb on mb.member_id = lyf.menid
								join gy_document as gy on gy.id=lb.shop_id
								join member_wechat as mw on mw.member_id=mb.member_id
								where lb.shop_id=$shopid and lyf.status = 1");
							$result = Array();
			foreach ($res as $key => $value) {
				$result[$key]['start_time'] = $value['start_time'];
				$result[$key]['end_time'] = $value['end_time'];
				$result[$key]['title'] = $value['title'];
				$result[$key]['name'] = $value['name'];
				$result[$key]['content'] = $value['content'];
				$result[$key]['explain'] = $value['explain'];
				$result[$key]['member_name'] = $value['member_name'];
				$result[$key]['headimgurl'] = $value['headimgurl'];
				$result[$key]['usetime'] = $value['usetime'];
			}
			$arrayName = array('data' =>$result , 'status'=>200 );
			echo json_encode($arrayName);

		}
/*—————————————————————————————————以下是私有类——————————————————————————————*/			
	    /*redis限制方法 暂未启用*/
private function limitForredis($onece){
			// $redis =  new \Redis();
			// $redis->connect();
			$limit = $onece;
			return $limit;
		}
private function randomProduct($info){
						$result=Array();
						$resinfo=Array();
						$pool=Array();
						$res = 100;
						foreach ($info as $key => $value) {
								$resinfo[$key]['data']['shop_id']=$value['shop_id'];
								$resinfo[$key]['data']['lot_type']=$value['name'];
								//奖券类型
								$resinfo[$key]['data']['explain']=$value['explain'];
								$resinfo[$key]['data']['content']=$value['content'];
								$resinfo[$key]['start_time']=$value['start_time'];
								$resinfo[$key]['end_time']=$value['end_time'];
								/*获取奖券的数量*/
								$resinfo[$key]['total']=$value['total_n'];
								$resinfo[$key]['over']=$value['over_n'];
								$resinfo[$key]['chest_id'] = $value['chest_id'];
								$resinfo[$key]['lottery_id'] = $value['lottery_id'];
								/*获取奖池的数量 有效剩余 抽奖次数 中奖次数*/
								$pool['lpid']=$value['id'];
								$pool['publish_total']=$value['publish_total'];
								$pool['still_stock']=$value['still_stock'];
								$pool['doprize_num']=$value['doprize_num'];
								$pool['win_prize_num']=$value['win_prize_num'];
								/*end*/
								$result[$key]=intval($value['prize_chance']);
								$res-= $value['prize_chance'];
						}
							array_push($result,$res);
							$result= $this->countWeight($result);
							$result=$resinfo[$result];
				$lj_tab = M('lottery_joinrole');
			 	$res = $lj_tab ->where('memb_id ='.$this->memb_id)->select();
			 	if(empty($res)){
					$res = $lj_tab->add(array('memb_id' => $this->memb_id));
				}
/*----如果没有中奖-----*/
if($result===NULL){
	try {
	$lj_tab->startTrans();	
	$role_info=$lj_tab ->where("memb_id=".$this->memb_id)->field('chest_id')->select();
	//td_joinnum 用户中奖次数
	// $role_info[0]['td_joinnum']=$role_info[0]['td_joinnum']+1;
	$result['chest_id']=I('type');
		/*-------宝箱-------*/
	   if($result['chest_id']>0){
			$res = in_array($result['chest_id'],explode(',', $role_info[0]['chest_id']));
		 	if(!empty($role_info[0]['chest_id'])){
				if(!$res){
					$role_info[0]['chest_id'].=",".$result['chest_id'];
				}else {
					$arrayName = array('status' =>202,'content'=>'同一个宝箱不能开奖2次');
					echo json_encode($arrayName);exit;
				}
			}else{
					$role_info[0]['chest_id']=$result['chest_id'];
				}

				$lj_tab->where('memb_id='.$this->memb_id)->save(array('chest_id'=> $role_info[0]['chest_id']));
		}else{
			// //奖池未中奖
			// $lj_tab->where('memb_id='.$this->memb_id)->save(array('td_joinnum'=>$role_info[0]['td_joinnum']));
			/*缓存用户抽奖次数*/
			$this->laravelcache(true);
		}
	}catch (\Exception $e){
		 		$lj_tab->rollback();
			   	echo json_encode(array('status'=>203,'content'=>'服务器繁忙请重新抽奖'.($e->getMessage())));
			   	exit;
	}

			$res=$lj_tab->commit();
			$arrayName = array('status' =>201,'content'=>'未中奖');
			echo json_encode($arrayName);exit;
	
}else{
	/*---------------中奖得到当前用户的奖券id 宝箱id 添加------------------*/
	$role_info=$lj_tab ->where("memb_id=".$this->memb_id)->field('td_joinnum,chest_id')->select();
		if(I('type')>0){
		if(!empty($role_info[0]['chest_id'])){
		if(!in_array($result['chest_id'],explode(',', $role_info[0]['chest_id']))){
				$role_info[0]['chest_id'].=",".$result['chest_id'];
			}else{
				$arrayName = array('status' =>202,'content'=>'同一个宝箱不能开奖2次');
    				echo json_encode($arrayName);exit;
			}
				}else{
					$role_info[0]['chest_id']=$result['chest_id'];
				}
			if($result['total']-1<=0){
				$lj_tab->where("memb_id=".$this->memb_id)->save(array('chest_id' =>$role_info[0]['chest_id']));
				echo json_encode(array('status' =>201,'content'=>'未中奖'));
				exit;
				}
			}else{
				if($result['total']-1<=0){
				$this->laravelcache(true);
				$arrayName = array('status' =>201,'content'=>'未中奖');
				echo json_encode($arrayName);
				exit;
				}
			}


	try{

		$lj_tab->startTrans();
			/*更新点击次数*/
			// $role_info[0]['td_joinnum']=$role_info[0]['td_joinnum']+1;
			$sql = array('only_key' =>$this->orderSN(), 'menid' => $this->memb_id,'l_id'=>$result['lottery_id'],'status' => 0);
			$resry = M('lotteryf_role')->add($sql);
		
		/*----------------------------------------end--------------------------*/
			// 更新奖券池数量 奖券数量 
			$role_info['total']= $result['total']>0 ? $result['total']-1 : 0;
			//发行数量 
			$role_info['over']=  $result['over_n']+1;
			//抽奖数量  
			// $pool["lpid"]=$pool["lpid"]+1; //奖池号
			// $pool["publish_total"]=$pool["publish_total"]>0 ? $pool["publish_total"]-1 : 0; //发行-总计
			// $pool["still_stock"]=$pool["still_stock"]+1;//有效剩余-总计
			// $pool["doprize_num"]=$pool["doprize_num"]+1;//抽奖次数
			$pool["win_prize_num"]=$pool["win_prize_num"]+1;//中奖次数
			if(I('type')==0){
				$sqlpool= " and c.id =".$pool["lpid"];
			}
		/*-------------------------更新用户数据-----------------------------*/
			 $sql = "UPDATE lottery_joinrole a,lottery b,lottery_pool c set a.chest_id='".$role_info[0]['chest_id'].
			 	 // "',a.td_joinnum='".$role_info[0]['td_joinnum'].
			 	 "',b.total_n=".$role_info['total'].
			 	 ",b.over_n=".$role_info['over'].
			 	 // ",c.publish_total=".$pool['publish_total'].
			 	 // ",c.still_stock=".$pool['still_stock'].
			 	 // ",c.doprize_num=".$pool['doprize_num'].
			 	 ",c.win_prize_num=".$pool['win_prize_num'].
			 	 " where a.memb_id=".$this->memb_id.
			 	 " and b.id =".$result['lottery_id'].
			 	 $sqlpool;
		 	     $res = $lj_tab->execute($sql);
		/*-------------------------------end-------------------------------*/
 				} catch (\Exception $e) {	
			        // rollback
			    $lj_tab->rollback();
			   	echo json_encode(array('status'=>202,'content'=>'服务器繁忙请重新抽奖'.($e->getMessage())));
			   	exit;
    		}
    			$lj_tab->commit();
    			if(!$res){
    				echo json_encode(array('status' => 203 ,'content'=>'未能正确提交'));
    				exit;
    			}else{
    				$shopid = $result['data']['shop_id'];
					$shopname = M('gy_document')->where("id = $shopid")->field('title')->select();
					$result['data']['shopname']=$shopname[0]['title'];
					$result['status'] =200;
					/*缓存抽奖次数*/
					$this->laravelcache(true);
					return $result;
    			}
    			exit;
					
	}
/* prize end*/

}

		private function countWeight($data){
				    $weight=0;
				    $temp=array();
				    foreach($data as $key=>$v){
				        $weight+=$v;
				        for($i=0;$i<$v;$i++){
				            $temp[][$key]=$v;//放大数组
				        }
				    }
				    $int=mt_rand(0,$weight-1);//获取一个随机数
				    $result = array_keys($temp[$int])[0];
				    return $result;
				}
		private function orderSN(){
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
			return $orderSn;
		}
/*----———————————————————— 微信二维码—————————————————————————————————*/
	private function product_qrcode($onlykey,$shopkey)
     {
        $id = $onlykey;
        $title = $shopkey;
        $only_key = $this->decrypt($onlykey,126);
      //引入二维码生成插件
        if(empty($id)||empty($shopkey)){
        	$arrayName = array('status' =>201,'content'=>'未含有奖券key');
    				echo json_encode($arrayName);exit;
        }
      vendor("phpqrcode.phpqrcode");
      // 生成的二维码所在目录+文件名
      $path = "./Uploads/QRcode/";//生成的二维码所在目录
       if(!file_exists($path)){
           mkdir($path, 0700,true);
       }
       $time = "ltttery_seller".$id.'.png';//生成的二维码文件名
       $fileName = $path.$time;//1.拼装生成的二维码文件路径
     $data = 'http://126wenren.ejar.com.cn/letterPool/LotterySellerData/?lotterykey='.$id.'&shopkey='.$title;//2.生成二维码的数据(扫码显示该数据)
       $level = 'L';  //3.纠错级别：L、M、Q、H
       $size = 10;//4.点的大小：1到10,用于手机端4就可以了
       ob_end_clean();//清空缓冲区
       \QRcode::png($data, $fileName, $level, $size);//生成二维码
       $fileName ="http://126wenren.ejar.com.cn".substr($fileName,1);
       $result = array('code'=>200,'data'=>array('url'=>$fileName),'info'=>"success");
       if($result['code']===200&&$result['info']==='success'){
       		M('lotteryf_role')->where("only_key='".$only_key."'")->save(array('urlqrcode'=>$result['data']['url']));
       		echo json_encode($result);exit;
       };
     }
      /*加密*/
   //    $data = 'PHP加密解密算法';    // 被加密信息
	  // $key = '126';    // 密钥
      private function encrypt($data, $key)
		{
		    $key    =    md5($key);
		    $x        =    0;
		    $len    =    strlen($data);
		    $l        =    strlen($key);
		    for ($i = 0; $i < $len; $i++)
		    {
		        if ($x == $l) 
		        {
		            $x = 0;
		        }
		        $char .= $key{$x};
		        $x++;
		    }
		    for ($i = 0; $i < $len; $i++)
		    {
		        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
		    }
		    return base64_encode($str);
		}
	/*解密*/
	 private function decrypt($data, $key)
	   {
	    $key = md5($key);
	    $x = 0;
	    $data = base64_decode($data);
	    $len = strlen($data);
	    $l = strlen($key);
	    for ($i = 0; $i < $len; $i++)
	    {
	        if ($x == $l) 
	        {
	            $x = 0;
	        }
	        $char .= substr($key, $x, 1);
	        $x++;
	    }
	    for ($i = 0; $i < $len; $i++)
	    {
	        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
	        {
	            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
	        }
	        else
	        {
	            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
	        }
	    }
	    return $str;
	}
	private function laravelcache($status){
			$shopid ='shop'.$this->shopid;
			$memb_id = $this->memb_id;//$this->memb_id
			if(empty(F($shopid))){
				$arrayName = array('shopid' =>$shopid,'num'=>Array());
				$res = F($shopid,$arrayName);
				$res=F($shopid)['num']=Array();
			}
			$arr = F($shopid);
			if($status&&!empty(F($shopid))&&!empty($memb_id)){
				$num = $arr['num'][$memb_id];
				if(empty($num)){
					$num+=1;
					
				}else{
					$num=$num+1;
				}
				$arr['num'][$memb_id]=$num;
					$res = F($shopid,$arr);
			}

			return $arr['num'][$memb_id];
		}
}
 ?>