<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class GoodsCarController extends LayoutController {


	public function add_to_car(){
		header('Content-type:text/json');
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			echo returnApi(201,'请先登录');
			return false;
		}
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
		echo returnApi(200,'','');
	}

	public function car(){
		// 检测状态
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('Member/login'));
		}
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
		}else{
			$this->error('购物车中没商品！~');
		}
		$this->display();
	}
}