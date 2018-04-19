<?php 
namespace Home\Model;
use Think\Model;

class TrademarkClassificationModel extends Model{



	public function getCidAndTitle($id){
		$d = $this->field('id,cid,title')->find($id);
		return $d;
	}

	// 1:11921,17988|952:18268,18266

	public function getArrData($str){
		if(!$str){
			return ;
		}
		$_arr = explode('|', $str);
		$arr = array();
		$__arr = array();
		foreach($_arr as $k=>$v){
			$__arr = explode(':', $v);
			$arr[$k]['topcid'] = $this->getCidAndTitle($__arr[0]);
			$childid = explode(',', $__arr[1]);
			foreach($childid as $k1=>$v1){
				$childid[$k1] = $this->getCidAndTitle($v1);
			}
			$arr[$k]['childid'] = $childid;
		}
		return $arr;
	}

	public function ajaxGetAllFromPid(){
		$pid = I('get.pid');
		$d = $this->field('id,cid,title')->where('pid=%d',$pid)->select();
		if($d){
			return returnApi(200,'success',$d);
		}else{
			return returnApi(201,'false');
		}
	}

	public function getName($id){
		$d = $this->field('title')->find($id);
		return $d['title'];
	}

	public function getCid($id){
		$d = $this->field('cid')->find($id);
		return $d['cid'];
	}

	public function getNameCid($id){
		$d = $this->field('title,cid')->find($id);
		return $d;
	}






}