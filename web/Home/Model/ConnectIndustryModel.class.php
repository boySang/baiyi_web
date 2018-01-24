<?php 
namespace Home\Model;
use Think\Model;

class ConnectIndustryModel extends Model{



	public function getAll($pid = 0){
		$d = $this->field('id,title')->where('pid=%d',$pid)->select();
		return $d;
	}

	public function ajaxGetAll(){
		$pid = I('get.pid');
		$d = $this->field('id,title')->where('pid=%d',$pid)->select();
		if($d){
			return returnApi(200,'success',$d);
		}else{
			return returnApi(201,'获取具体行业失败');
		}
	}

	public function ajaxGetOneFromId(){
		$id = I('get.id');
		$_d = $this->field('connect_val')->where('id=%d',$id)->find();
		if($_d){
			$m = D('TrademarkClassification');
			$_d['connect_val_arr'] = $m->getArrData($_d['connect_val']);
			return returnApi(200,'success',$_d);
		}else{
			return returnApi(201,'获取具体行业失败');
		}
	}

}