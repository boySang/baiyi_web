<?php 
namespace Admin\Model;
use Think\Model;

class OptAttrValModel extends Model{

	public function getAll($attr_id,$type = 'arr'){


		$d = $this->field('id,name')->where('attr_id=%d',$attr_id)->select();
		$total = $this->where('attr_id=%d',$attr_id)->count();
		if($type == 'str'){
			$_d = array();
			foreach($d as $k=>$v){
				$_d[$k] = $v['name'];
			}
			return implode(',',$_d);
		}else{
			return array(
				'data'	=>	$d,
				'total'	=>	$total,
			);
		}
	}

	public function ajaxGetAll($attr_id){
		$d = $this->where('attr_id=%d',$attr_id)->select();
		if($d){
			return returnApi(200,'获取成功',$d);
		}else{
			return returnApi(201,'未查询到该属性值');
		}
	}

	public function getName($id){
		$d = $this->field('name')->find($id);
		return $d['name'];
	}

	public function getPName($id){
		$d = $this->field('attr_id')->find($id);
		$OptAttrModel = D('OptAttr');
		$OptAttrData = $OptAttrModel->getName($d['attr_id']);
		return $OptAttrData;
	}

	public function isHas($attr_id){
		$d = $this->field('id')->where('attr_id=%d',$attr_id)->select();
		if($d){
			return true;
		}else{
			return false;
		}
	}

	public function delFromAttrId($attr_id){
		$d = $this->execute("DELETE FROM by_opt_attr_val WHERE attr_id=".$attr_id);
	}

}