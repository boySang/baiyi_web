<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {


    public function detail($id){
    	$m = D('Goods');
    	$d = $m->getGoodsOne($id);
    	$data['goodsinfo'] = $d;
    	// 获取侧边栏及里面的内容
    	$cateModel = D('Category');
    	$cateMenu = $cateModel->getMenuPublic();
    	$data['menu'] = $cateMenu;
    	$this->assign(array(
    		'data'		=>		$data,
    		'name'		=>		$d['goods_name'].'_',
    	));
		$this->display();
    }
    
}