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

    public function confirm(){
    	$temp['goods_id'] = I('post.id');
    	$temp['goods_name'] = I('post.goods_name');
    	$temp['goods_num'] = I('post.good_nums');
    	$temp['goods_price'] = I('post.goods_price');
    	$temp['total_price'] = $temp['goods_num']*$temp['goods_price'];
    	$this->assign('data',$temp);
    	$this->display();
    }
}