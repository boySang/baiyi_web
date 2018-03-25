<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class GoodsCarController extends LayoutController {


	public function add_to_car(){
		$goods_id = I('post.id');
		$good_nums = I('post.good_nums');
		$car_session = session('temp_goodscar')?session('temp_goodscar'):array();
		session('temp_goodscar',null);
		if($car_session[$goods_id]){
			$car_session[$goods_id]['nums'] += $good_nums;
			// 以后还有属性的保存

		}else{
			$car_session[$goods_id]['nums'] = $good_nums;;
			// 以后还有属性的保存

		}
		session('temp_goodscar',$car_session);
		header('Content-type:text/json');
		echo returnApi(200,'','');
	}

	public function car(){
		$car_session = session('temp_goodscar')?session('temp_goodscar'):array();
		if($car_session != null){
			$goodsModel = D('Goods');
			foreach($car_session as $k=>$v){
				$goodsInfo = $goodsModel->getGoodsInfoToCar($k);
				$car_session[$k]['goods_id'] = $k;
				$car_session[$k]['goods_name'] = $goodsInfo['goods_name'];
				$car_session[$k]['goods_default_price'] = $goodsInfo['goods_default_price'];
				$car_session[$k]['total_price'] = $goodsInfo['goods_default_price'] * $v['nums'];
			}
			// var_dump($car_session);
			$this->assign('data',$car_session);
		}
		if($car_session)
		$this->display();
	}
}