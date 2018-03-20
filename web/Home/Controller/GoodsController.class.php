<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\Baitu;
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

    public function get(){
    	$m = new Baitu();
    	$r = $m->getTrademarkInquiries(APIKEY,APIKEYID,'张','01,02',2,10,1);
    	echo $_r;
    }

    public function text(){
    	$this->display();
    }

} 