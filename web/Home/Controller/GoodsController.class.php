<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
use Org\Util\Baitu;
class GoodsController extends LayoutController {


    public function detail($id){
    	if(!is_numeric($id)){
    		$this->error('参数不合法');
    	}
    	$m = D('Goods');
    	$d = $m->getGoodsOne($id);
    	if(!$d){
    		$this->error('找不到该商品');
    	}
    	$data['goodsinfo'] = $d;
    	// 获取侧边栏及里面的内容
    	$cateModel = D('Category');
    	$cateMenu = $cateModel->getMenuPublic();
    	$data['menu'] = $cateMenu;

    	// 调取帮助文章
    	$goodsProblem_m = D('GoodsProblem');
    	$goodsProblem_d = $goodsProblem_m->getFromGoodsId($id);
    	$this->assign(array(
    		'data'		=>		$data,
    		'name'		=>		$d['goods_name'].'_',
    		'goodspro'	=>		$goodsProblem_d,
    	));
		$this->display();
    }

    public function get(){
    	$m = new Baitu();
    	$r = $m->getTrademarkInquiries('张','01,02',2,10,1);
    	echo $_r;
    }

    public function text(){
    	$this->display();
    }

} 