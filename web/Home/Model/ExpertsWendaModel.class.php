<?php 
namespace Home\Model;
use Think\Model;

class ExpertsWendaModel extends Model{


	public function getInfo($pid,$limit = 0){
		$d = $this->field('id,title,answer,addtime')->where('pid=%d',$pid)->limit($limit)->select();
		foreach($d as $k=>$v){
			$d[$k]['addtime'] = date('Y-m-d',$v['addtime']);
		}
		return $d;
	}
}