<?php 
namespace Home\Model;
use Think\Model;

class OrderDetailModel extends Model{

	// 这里模拟插入数据库，创建订单，生成订单号，合同号，state=0，然后去支付
	public function addToOrder(){

		// 这个模拟通过，插入数据库订单数据,state=0,并且返回订单号：
		if(true){
			// 比如订单号为1
			$id = '1';
			return returnApi(200,'订单创建成功','',U('OrderDetail/pay/id/'.$id));
		}
	}

	public function getOneFromUniquenum($uniquenum){
		$d = $this->field('goods_name,total_price,addtime,uniquenum,contract_number,state,goods_attr,order_type')->where('uniquenum="%s" AND member_uniqid="%s"',$uniquenum,session('uniqid'))->find();
		if($d){
			$d['total_price'] = $d['total_price']/100;
			return $d;
		}
	}

	public function getGoodsName($uniquenum){
		$d = $this->field('goods_name')->where('uniquenum="%s" AND member_uniqid="%s"',$uniquenum,session('uniqid'))->find();
		return $d['goods_name'];
	}

	public function getOrderList(){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			return returnApi(199,'已经登录！');
		}
		$state = I('get.state','','htmlspecialchars');
		$page = I('get.page')>0?(I('get.page')-1)*10:0;
		$where = 'member_uniqid="'.session('uniqid').'"';
		if($state == 0){
			$where = 'member_uniqid="'.session('uniqid').'"';
		}elseif($state == 300){
			$where .= ' AND state<>104';
		}else{
			$where .= ' AND state='.$state;
		}
		$d = $this->field('goods_name,total_price,addtime,paytime,uniquenum,contract_number,state,order_type')->where($where)->order('id DESC')->limit($page,10)->select();
		if($d){
			foreach($d as $k=>$v){
				$d[$k]['addtime'] = date('Y-m-d',$v['addtime']);
				$d[$k]['paytime'] = date('Y-m-d',$v['paytime']);
				$d[$k]['total_price'] = $v['total_price']/100;
				if($v['order_type'] == 1){
					$d[$k]['goods_name'] = $v['goods_name'].'<font color="#d9534f">（商标自助申请）</font>';
					// 订单状态
					if($v['state'] == 101){
						$d[$k]['state_name'] = '已付款';
						$d[$k]['action'] = '<a href="'.U('OrderDetail/uploadinfomations/id/'.$v['uniquenum']).'" id="to-pay" class="to-pay actions" style="background: #3baaf2;">上传资料</a><a href="javascript:void(0);" id="del-order" class="del-order">退款</a>';
					}elseif($v['state'] == 102){
						$d[$k]['state_name'] = '已上传资料';
						$d[$k]['action'] = '<a href="'.U('OrderDetail/uploadinfomations/id/'.$v['uniquenum']).'" id="to-pay" class="to-pay actions" style="background: #3baaf2;">上传资料</a>';
					}elseif($v['state'] == 103){
						// $d[$k]['state_name'] = '已上传合同';
						// $d[$k]['action'] = '<a href="javascript:void(0);" id="to-pay" class="to-pay">上传合同</a>';
					}elseif($v['state'] == 104){
						$d[$k]['state_name'] = '已邮寄';
						$d[$k]['action'] = '<a href="javascript:void(0);" id="to-pay" class="to-pay actions">正在安排邮寄</a>';
					}elseif($v['state'] == 201){
						$d[$k]['state_name'] = '未付款';
						$d[$k]['action'] = '<a href="'.U('OrderDetail/pay_again/uniquenum/'.$v['uniquenum']).'" id="to-pay" class="to-pay actions" style="background:#d9534f;">立即支付</a><a href="javascript:void(0);" id="del-order" class="del-order">关闭订单</a>';
					}elseif($v['state'] == 202){
						$d[$k]['state_name'] = '上传资料';
						$d[$k]['action'] = '<a href="'.U('OrderDetail/uploadinfomations/id/'.$v['uniquenum']).'" id="to-pay" class="to-pay actions">继续上传资料</a>';
					}elseif($v['state'] == 203){
						// $d[$k]['state_name'] = '未上传合同';
						// $d[$k]['action'] = '<a href="javascript:void(0);" id="to-pay" class="to-pay">上传合同</a>';
					}elseif($v['state'] == 204){
						$d[$k]['state_name'] = '未邮寄';
						$d[$k]['action'] = '<a href="javascript:void(0);" id="to-pay" class="to-pay actions">正在安排邮寄</a>';
					}
				}else{
					if($v['state'] == 101){
						$d[$k]['state_name'] = '已付款';
						$d[$k]['action'] = '<a href="javascript:;" id="to-pay" class="to-pay actions" style="background:#f0ad4e;">联系客服</a>';
					}else{
						$d[$k]['state_name'] = '未付款';
						$d[$k]['action'] = '<a href="'.U('OrderDetail/pay_again/uniquenum/'.$v['uniquenum']).'" id="to-pay" class="to-pay actions" style="background:#d9534f;">立即支付</a><a href="javascript:void(0);" id="del-order" class="del-order">关闭订单</a>';
					}
				}
			}
			return returnApi(200,'success',$d);
		}else{
			return returnApi(201,'未查询到订单');
		}
	}


	protected function _before_insert(&$data, $options){
		$orderDetail['addtime'] = time();
	}
}