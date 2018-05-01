<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class TrademarkClassificationController extends LayoutController {



	public function ajaxGetAllFromPid(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxGetAllFromPid();
	}

	// 小程序接口调用的方法，获取pid=0时，全部分类，及第一个分类下的部分商品项
	public function getTrademarkClassTop(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->getTrademarkClassTop();
	}

	// 小程序接口调用的方法，获取pid下的列表
	public function getTrademarkClassFromPid(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->getTrademarkClassFromPid();
	}
}