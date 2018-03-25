<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class IndexController extends LayoutController {


    public function index(){
    	// 获取首页【国内商标在线申请】6个商品
    	$goodsModel = D('Goods');
    	$data['DomesticTrademark'] = $goodsModel->getGoodsToHome(1);
    	// 获取首页【专利在线申请】6个商品
    	$data['Patent'] = $goodsModel->getGoodsToHome(4);
    	// 获取首页【版权在线申请】6个商品
    	$data['Copyright'] = $goodsModel->getGoodsToHome(3);
    	$this->assign(array(
    		'data'		=>		$data,
    	));
        $this->display();
    }

}