<?php
namespace Home\Controller;
use Think\Controller;
class ConnectIndustryController extends Controller {

	public function aiplan(){
		$m = D('ConnectIndustry');
		$type = $m->getAll();
		$this->assign(array(
			'type'		=>		$type,
		));
		$this->display();
	}

	public function ajaxGetAll(){
		header('Content-type:text/json');
		$m = D('ConnectIndustry');
		echo $m->ajaxGetAll();
	}

	public function ajaxGetOneFromId(){
		header('Content-type:text/json');
		$m = D('ConnectIndustry');
		echo $m->ajaxGetOneFromId();
	}

	public function selectgoods(){
		$m = D('ConnectIndustry');
		$type = $m->getAll();
		$this->assign(array(
			'type'		=>		$type,
		));
		$this->display();
	}

	public function ipsearch(){
		$this->display();
	}


    // 用户自助选择商品项后，确认的页面
    public function zizhu_confirm(){
    	$this->display();
    }

    public function confirm($id){
    	$orderDetailModel = D('OrderDetail');
    	$TrademarkClassificationModel = D('TrademarkClassification');
    	$orderDetailData = $orderDetailModel->getOneFromUniquenum($id);
    	$arr = array();
    	$_arr = explode('|', $orderDetailData['goods_attr']);
    	foreach($_arr as $k=>$v){
    		$__arr = explode('-', $v);
    		$arr[$k]['type'] = $TrademarkClassificationModel->getCid($__arr[0]).'&nbsp;'.$TrademarkClassificationModel->getName($__arr[0]);
    		$___arr = explode('.', $__arr[1]);
    		$temparr = array();
    		foreach($___arr as $k1=>$v1){
    			$arr[$k]['val'] .= $TrademarkClassificationModel->getCid($v1).'&nbsp;'.$TrademarkClassificationModel->getName($v1).'，';
    		}
    	}
    	$data['goods_name'] = $orderDetailData['goods_name'];
    	$data['total_price'] = $orderDetailData['total_price'];
    	$data['addtime'] = $orderDetailData['addtime'];
    	$data['uniquenum'] = $orderDetailData['uniquenum'];
    	$data['contract_number'] = $orderDetailData['contract_number'];
    	$data['goods_attr'] = $arr;
    	$this->assign('data',$data);
    	$this->display();
    }

    // 选择付款方式
    public function confirm_ok($id){
    	$orderDetailModel = D('OrderDetail');
    	$data = $orderDetailModel->getOneFromUniquenum($id);
    	$data['addtime'] = date('Y-m-d',$data['addtime']);
    	$this->assign('data',$data);
    	$this->display();
    }

    public function onekeysearch(){
    	$m = D('ConnectIndustry');
		$type = $m->getAll();
		$this->assign(array(
			'type'		=>		$type,
		));
    	$this->display();
    }


















}