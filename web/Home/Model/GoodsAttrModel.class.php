<?php 
namespace Home\Model;
use Think\Model;

class GoodsAttrModel extends Model{


	public function getAllFromGoodsId($goods_id){
		$d = $this->where('goods_id=%d',$goods_id)->select();
		if($d){
			$_d = array();
			$opt_attr_val_m = D('OptAttrVal');
			foreach($d as $k=>$v){
				if($v['type'] == 1){
					$_d['type1'][$k] = $v;
					$_d['type1'][$k]['attr_name'] = $opt_attr_val_m->get_name($v['attrval']);;
				}else{
					$_d['type0'][$k] = $v;
					$_d['type0'][$k]['attr_name'] = $opt_attr_val_m->get_name($v['attrval']);;
				}
			}
			return $_d;
		}
	}
}