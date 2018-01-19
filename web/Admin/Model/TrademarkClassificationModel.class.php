<?php 
namespace Admin\Model;
use Think\Model;

class TrademarkClassificationModel extends Model{




	public function ajaxGetAll(){
		$d = $this->field('id,cid,title')->where('pid=0 AND state=1')->select();
		foreach($d as $k=>$v){
			$d[$k]['child'] = $this->field('id,cid,title')->where('pid='.$v['id'].' AND state=1')->select();
			foreach($d[$k]['child'] as $k1=>$v1){
				$d[$k]['child'][$k1]['child'] = $this->field('id,cid,title')->where('pid='.$v1['id'].' AND state=1')->select();
			}
		}
		if($d){
			return returnApi(200,'success',$d);
		}else{
			return returnApi(201,'未查询到数据');
		}
	}



}