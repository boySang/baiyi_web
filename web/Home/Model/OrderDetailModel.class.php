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
		$d = $this->field('goods_name,total_price,addtime,uniquenum,contract_number')->where('uniquenum="%s"',$uniquenum)->find();
		$d['total_price'] = $d['total_price']/100;
		return $d;
	}


	protected function _before_insert(&$data, $options){
		$orderDetail['addtime'] = time();
	}
}