<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
use Org\Util\Baitu;
class ConnectIndustryController extends LayoutController {

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

	// 接受post数据并处理
	public function ipresult(){
		$this->display();
	}

    // 用户自助选择商品项后，确认的页面
    public function zizhu_confirm(){
    	$this->display();
    }

    public function confirm($id){
    	$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('Member/login'));
		}
    	$orderDetailModel = D('OrderDetail');
    	$TrademarkClassificationModel = D('TrademarkClassification');
    	$orderDetailData = $orderDetailModel->getOneFromUniquenum($id);
    	$arr = array();
    	$_arr = explode('|', $orderDetailData['goods_attr']);
    	foreach($_arr as $k=>$v){
    		$__arr = explode('-', $v);
    		$arr[$k]['type'] = '第'.$TrademarkClassificationModel->getCid($__arr[0]).'类&nbsp;';
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
    	$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('Member/login'));
		}
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

    public function getTrademarkInquiries(){
    	$cxkey = I('post.cxkey');
    	$cxcls = I('post.cxcls','');
    	$cxtype = I('post.cxtype')?I('post.cxtype'):2;
    	$pagesize = I('post.pagesize')?I('post.pagesize'):15;
    	$pageno = I('post.pageno')?I('post.pageno'):1;
    	// if($cxkey == '' || $cxtype == '' || $pagesize == ''){
    	// 	echo returnApi(201,'参数错误');
    	// 	return false;
    	// }
    	$m = new Baitu();
    	$r = $m->getTrademarkInquiries($cxkey,$cxcls,$cxtype,$pagesize,$pageno);
    	echo $_r;
    }

    public function getTrademarkInquiriesNew(){
    	header('Content-type:text/json');
    	$cxkey = I('post.cxkey');
    	$cxcls = I('post.cxcls','');
    	$cxtype = I('post.cxtype')?I('post.cxtype'):2;
    	$pagesize = I('post.pagesize')?I('post.pagesize'):15;
    	$pageno = I('post.pageno')?I('post.pageno'):1;
    	// if($cxkey == '' || $cxtype == '' || $pagesize == ''){
    	// 	echo returnApi(201,'参数错误');
    	// 	return false;
    	// }
    	$m = new Baitu();
    	$r = $m->getTrademarkInquiries($cxkey,$cxcls,$cxtype,$pagesize,$pageno);
    	echo $_r;
    }

    // 读取一个商标的详细信息
    public function readmore($regno){
    	if(($regno != null) || ($regno != '')){
    		$this->display();
    	}
    }

    // ajax获取商标详细信息
    public function getmoreinfo(){
    	$regno = I('get.regno');
    	$intcls = I('get.intcls');
		if($regno == '' || $intcls == ''){
    		echo returnApi(201,'参数错误');
    		return false;
    	}
    	$m = new Baitu();
    	$r = $m->getTrademarkInfo($regno,$intcls);
    	echo $_r;
    }

    // ajax获取商标详细信息
    public function getmoreinfoNew(){
    	header('Content-type:text/json');
    	$regno = I('get.regno');
    	$intcls = I('get.intcls');
		if($regno == '' || $intcls == ''){
    		echo returnApi(201,'参数错误');
    		return false;
    	}
    	$m = new Baitu();
    	$r = $m->getTrademarkInfo($regno,$intcls);
    	echo $_r;
    }

    // ajax获取商标流程
    public function getflow(){
    	$regno = I('get.regno');
    	$intcls = I('get.intcls');
		if($regno == '' || $intcls == ''){
    		echo returnApi(201,'参数错误');
    		return false;
    	}
    	$m = new Baitu();
    	$r = $m->getTrademarkProcess($regno,$intcls);
    	echo $_r;
    }


















}