<?php 
namespace Home\Model;
use Think\Model;

class OrderDetailModel extends Model{

	// 这里模拟插入数据库，创建订单，生成订单号，合同号，state=0，然后去支付
	public function addToOrder(){

		// 这个模拟通过，插入数据库订单数据,state=0,并且返回订单号：
		if(true){
			// 比如订单号为1
			$id = '1';
			return returnApi(200,'订单创建成功','',U('OrderDetail/pay/id/'.$id));
		}
	}

	public function getOneFromUniquenum($uniquenum){
		$d = $this->field('goods_name,total_price,addtime,uniquenum,contract_number,state,goods_attr')->where('uniquenum="%s"',$uniquenum)->find();
		$d['total_price'] = $d['total_price']/100;
		return $d;
	}

	public function getOrderList(){
		$state = I('get.state','','htmlspecialchars');
		$page = I('get.page')>0?(I('get.page')-1)*10:0;
		$where = '1';
		if($state == 0){
			$where = '1';
		}elseif($state == 300){
			$where = 'state<>104';
		}else{
			$where = 'state='.$state;
		}
		$d = $this->field('goods_name,total_price,addtime,paytime,uniquenum,contract_number,state')->where($where)->order('id DESC')->limit($page,10)->select();
		if($d){
			foreach($d as $k=>$v){
				$d[$k]['addtime'] = date('Y-m-d',$v['addtime']);
				$d[$k]['paytime'] = date('Y-m-d',$v['paytime']);
				$d[$k]['total_price'] = $v['total_price']/100;
			}
			return returnApi(200,'success',$d);
		}else{
			return returnApi(201,'未查询到订单');
		}
	}


	protected function _before_insert(&$data, $options){
		$orderDetail['addtime'] = time();
	}
}