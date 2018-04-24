<?php 
namespace Admin\Model;
use Think\Model;

class ExpertsWendaModel extends Model{

	public function getTopNav(){
		$d = $this->field('id,title')->where('pid=0')->select();
		return $d;
	}



    protected function _before_insert(&$data, $options){
    	$data['addtime'] = time();
    }
}