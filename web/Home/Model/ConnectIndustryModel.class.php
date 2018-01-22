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

}