<?php
namespace Home\Controller;
use Home\Controller\LayoutController;

class OrderDetailController extends LayoutController {

	public function getOrderList(){
		header('Content-type:text/json');
		$m = D('OrderDetail');
		echo $m->getOrderList();	
	}


	// 添加订单数据到数据库，在这里创建订单号，合同号，state=0
	public function addToOrder(){
		header('Content-type:text/json');
		$m = D('OrderDetail');
		echo $m->addToOrder();		
	}

	// ajax创建订单
	public function creat_order(){
	    header('Content-type:text/json');
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			echo returnApi(201,'请先登录');
			return false;
		}
		if(I('post.send') == 'ok'){
			$m = D('OrderDetail');
			$temp['goods_id'] = I('post.id');
	    	$temp['goods_name'] = I('post.goods_name');
	    	$temp['goods_num'] = I('post.good_nums');
	    	$temp['goods_price'] = I('post.goods_price');
			$temp['uniquenum'] = 'BY'.date('YmdHis',time()).rand(100,999);
			$temp['goods_attr'] = I('post.goods_attr');
			$temp['contract_number'] = 'CN'.date('YmdHis',time()).rand(100,999);
			$temp['addtime'] = date('Y-m-d',time());
			// echo returnApi(200,$temp);
			// return false;
			// 单买的时候
			if((count(I('post.id')) <= 1) && !is_array(I('post.id'))){
    			$orderDetail['uniquenum'] = $temp['uniquenum'];
	    		$orderDetail['goods_id'] = $temp['goods_id'];
	    		$orderDetail['goods_name'] = $temp['goods_name'];
	    		$orderDetail['goods_num'] = $temp['goods_num'];
	    		$orderDetail['goods_price'] = $temp['goods_price']*100;
	    		$orderDetail['total_price'] = $temp['goods_num']*$temp['goods_price']*100;
	    		$orderDetail['contract_number'] = $temp['contract_number'];
	    		$orderDetail['goods_attr'] = $temp['goods_attr'];
	    		$orderDetail['addtime'] = strtotime($temp['addtime']);
	    		$orderDetail['member_uniqid'] = session('uniqid');
	    		$result = $m->add($orderDetail);
	    		if($result){
	    			$orderGoodsDetailModel = D('OrderGoodsDetail');
	    			$detail['order_id'] = $orderDetail['uniquenum'];
	    			$detail['goods_name'] = $temp['goods_name'];
	    			$detail['goods_num'] = $temp['goods_num'];
	    			$detail['goods_price'] = $temp['goods_price']*100;
	    			$detail['goods_total_price'] = $temp['goods_num']*$temp['goods_price']*100;
	    			$detail['goods_attr'] = $temp['goods_attr'];
	    			$detail['goods_id'] = $temp['goods_id'];
	    			$r = $orderGoodsDetailModel->add($detail);
	    			// 日志操作记录
	    			if($r){
	    				echo returnApi(200,'','',U('OrderDetail/confirm'));
	    			}else{
	    				echo returnApi(201,'订单创建成功，但是商品项插入失败！');
	    			}
	    		}else{
	    			echo returnApi(201,'订单创建失败！');
	    		}
	    	}else{
	    		// 这里处理购物车中的物品
	    		$orderDetail = array();
	    		$orderDetail['total_price'] = 0;
	    		foreach($temp['goods_id'] as $k=>$v){
	    			$orderDetail['goods_name'] .= $temp['goods_name'][$k].'、';
	    			$orderDetail['total_price'] += ($temp['goods_num'][$k] * $temp['goods_price'][$k])*100;
	    		}
    			$orderDetail['uniquenum'] = $temp['uniquenum'];
    			$orderDetail['contract_number'] = $temp['contract_number'];
	    		$orderDetail['addtime'] = strtotime($temp['addtime']);
	    		$orderDetail['member_uniqid'] = session('uniqid');
	    		$result = $m->add($orderDetail);
	    		if($result){
	    			$orderGoodsDetailModel = D('OrderGoodsDetail');
	    			$orderGoodsDetail = array();
	    			foreach($temp['goods_id'] as $k=>$v){
	    				$orderGoodsDetail[$k]['goods_id'] = $temp['goods_id'][$k];
	    				$orderGoodsDetail[$k]['order_id'] = $orderDetail['uniquenum'];
	    				$orderGoodsDetail[$k]['goods_name'] = $temp['goods_name'][$k];
	    				$orderGoodsDetail[$k]['goods_num'] = $temp['goods_num'][$k];
	    				$orderGoodsDetail[$k]['goods_price'] = $temp['goods_price'][$k]*100;
	    				$orderGoodsDetail[$k]['goods_total_price'] = ($temp['goods_price'][$k]*$temp['goods_num'][$k])*100;
	    			}
	    			$r = $orderGoodsDetailModel->addAll($orderGoodsDetail);
	    			// 日志操作记录
	    			if($r){
	    				echo returnApi(200,'','',U('OrderDetail/confirm'));
	    			}else{
	    				echo returnApi(201,'购物车内订单创建成功，但是商品项插入失败！');
	    			}
	    		}else{
	    			echo returnApi(201,'购物车订单创建失败！');
	    		}
	    	}
	    	// 订单号
	    	session('temp_creat_order_number',null);
	    	session('temp_creat_order_number',$temp['uniquenum']);
	    	unset($temp);
	    	unset($orderDetail);
	    	unset($detail);
		}else{
			echo returnApi(202,'数据错误！');
		}
	}

	// 这里是购买确认页面，显示一遍购买内容的信息
    public function confirm(){
    	$temp_creat_order_number = session('temp_creat_order_number');
    	// 清除购物车
		session('temp_goodscar',null);
    	if($temp_creat_order_number){
    		$orderDetailModel = D('OrderDetail');
    		$data = $orderDetailModel->getOneFromUniquenum($temp_creat_order_number);
    		$data['addtime'] = date('Y-m-d',$data['addtime']);
    		// var_dump($data);
    		$this->assign('data',$data);
	    	$this->display();
    	}else{
    		// 错误页面
    		$this->error('参数错误');
    	}
    }

    // 这里是购买确认页面，显示一遍购买内容的信息
    public function pay_again(){
    	$uniquenum = I('get.uniquenum');
    	if($uniquenum){
    		$orderDetailModel = D('OrderDetail');
    		$data = $orderDetailModel->getOneFromUniquenum($uniquenum);
    		// var_dump($data);
    		$this->assign('data',$data);
	    	$this->display();
    	}else{
    		// 错误页面
    		$this->error('参数错误');
    	}
    }

    // 自助选择商品类及商品项，创建订单
    public function order_create_zizhu(){
    	header('Content-type:text/json');
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			echo returnApi(222,'请先登录');
			return false;
		}
    	$keywords = I('post.keywords','','htmlspecialchars');
    	// $type = I('post.type','','htmlspecialchars');
    	// $val = I('post.val','','htmlspecialchars');
    	$goodsattr = I('post.goodsattr','','htmlspecialchars');
    	if($keywords == '' || $goodsattr == ''){
    		echo returnApi(201,'参数不能为空');
    		return false;
    	}
		$orderDetailModel = D('OrderDetail');
		$trademarkClassificationModel = D('TrademarkClassification');
		// 先简单储存一下
		$data['goods_name'] = $keywords;
		// 价格再循环
		$total_price = 0;
		$_arr = explode('|', $goodsattr);
		// 基础官费300，基础代理费1000
		$guanfei = 0;
		$daili = 0;
		$tips = '';
		foreach($_arr as $k=>$v){
			// 代理费叠加1000
			$daili += 1000;
			$guanfei += 300;
			$__arr = explode('-', $v);

			// 顺便记录名称
			$topname = $trademarkClassificationModel->getName($__arr[0]);
			$tips .= $topname.'：';

			// 其中$__arr[0]是分类，$__arr[1]是商品项
			$goodsarr = explode('.', $__arr[1]);

			foreach($goodsarr as $k1=>$v1){
				if($k1 >= 10){
					$guanfei += 30;
					$daili += 70;
				}
				// 顺便记录名称和cid
				$goodsname = $trademarkClassificationModel->getNameCid($v1);
				$tips .= $goodsname['cid'].' '.$goodsname['title'].'，';
			}
			$tips .= '<br />';
		}
		$data['total_price'] = ($daili+$guanfei)*100;
		$data['tips'] = htmlspecialchars($tips);
		$data['uniquenum'] = 'BY'.date('YmdHis',time()).rand(100,999);
		$data['contract_number'] = 'CN'.date('YmdHis',time()).rand(100,999);
		$data['order_type'] = 1;
		$data['addtime'] = time();
		$data['goods_attr'] = $goodsattr;
		$data['member_uniqid'] = session('uniqid');
		$result = $orderDetailModel->add($data);
		if($result){
			echo returnApi(200,'','',U('ConnectIndustry/confirm/id/'.$data['uniquenum']));
			unset($data);
			return false;
		}else{
			echo returnApi(201,'订单生成失败！');
			return false;
		}
    }


	public function pay(){
		// 具体支付信息，及支付方式
		// $this->assign();
		$this->display();
	}

	public function uploadInfomations($id){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('Member/login'));
		}
		$m = D('OrderDetail');
		$goods_name = $m->getGoodsName($id);
		$this->assign(array(
			'goods_name'		=>		$goods_name,
		));
		$this->display();
	}

	// 根据字符串输出图片
	public function tubeimg($str){
		$im    = imagecreate( 150, 100 );#建立一个图片对象
		imagecolorallocate( $im, 255, 255, 255 );#将图片背景填充为白色
		$Color = imagecolorallocate( $im, 0, 0, 0 ); #在生成一黑色色颜色，以便写入字符串
		imagestring($im,16, 15, 36, $str, $Color);#将字符串写到图片上
		header('content-type:image/*');//设置文件头为图片格式
		imagejpeg( $im ); //输出一个png格式的图片
		imagedestroy($im);//销毁图片对象
	}
}