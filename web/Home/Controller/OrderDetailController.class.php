<?php
namespace Home\Controller;
use Think\Controller;

class OrderDetailController extends Controller {


	// 添加订单数据到数据库，在这里创建订单号，合同号，state=0
	public function addToOrder(){
		header('Content-type:text/json');
		$m = D('OrderDetail');
		echo $m->addToOrder();		
	}

	// 这里是购买确认页面，显示一遍购买内容的信息
	public function confirm(){
		if(IS_POST){
			$m = D('OrderDetail');
			// $this->assign();
			$this->display();
		}else{
			$this->error('订单错误');
		}
	}

	public function pay(){
		// 具体支付信息，及支付方式
		// $this->assign();
		$this->display();
	}
}