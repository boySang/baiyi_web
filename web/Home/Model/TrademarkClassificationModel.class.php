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

	public function getTrademarkClassTop(){
		if(F('getTrademarkClassTop')){
			$d = F('getTrademarkClassTop');
		}else{
			$d = $this->field('id,title,pid')->where('pid=0')->order('cid ASC')->select();
			if($d){
				foreach($d as $k=>$v){
					$d_mid = $this->field('id')->where('pid=%d',$v['id'])->order('id ASC')->find();
					$d[$k]['lte_goods'] = $this->field('id,title,pid')->where('pid=%d',$d_mid['id'])->limit(8)->order('id ASC')->select();
				}
				F('getTrademarkClassTop',$d);
				$d = F('getTrademarkClassTop');
			}else{
				return returnApi(201,'暂无数据');
			}
		}
		return returnApi(200,'success',$d);
	}

	public function getTrademarkClassFromPid(){
		$id = I('get.id');
		if(!is_numeric($id)){
			return returnApi(201,'参数错误');
		}
		if(F('getTrademarkClassFromPid_'.$id)){
			$d = F('getTrademarkClassFromPid_'.$id);
		}else{
			$d = $this->field('id,title,pid')->where('pid=%d',$id)->select();
			if($d){
				F('getTrademarkClassFromPid_'.$id,$d);
				$d = F('getTrademarkClassFromPid_'.$id);
			}else{
				return returnApi(201,'暂无数据');
			}
		}
		return returnApi(200,'success',$d);
	}






}