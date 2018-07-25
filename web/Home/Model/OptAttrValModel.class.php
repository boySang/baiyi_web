<?php 
namespace Home\Model;
use Think\Model;

class OptAttrValModel extends Model{


	public function get_name($id){
		$d = $this->field('name')->find($id);
		return $d['name'];
	}
}