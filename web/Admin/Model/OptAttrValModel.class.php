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
}