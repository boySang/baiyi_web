<?php
namespace Admin\Controller;
use Think\Controller;
class OrderDetailController extends Controller {



	public function show($uniqid){
		
		$m = D('OrderDetail');
		$d = $m->getFromUniqid($uniqid);
		// var_dump($d);
		$this->assign(array(
			'data'			=>		$d,
		));
		$this->display();
	}
}