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

	public function ajaxAddGroup(){
		$data['cid'] = I('get.cid','');
		$data['title'] = I('get.title');
		$data['pid'] = I('get.pid');
		$r = $this->data($data)->add();
		if($r){
			return returnApi(200,'success',$r);
		}else{
			return returnApi(202,'插入数据失败！');
		}
	}

	public function ajaxUpdateGroup(){
		$cid = I('get.cid','');
		$title = I('get.title','');
		$id = I('get.id');
		$r = $this->where('id=%d',$id)->setField(array(
			'cid'	=>	$cid,
			'title'	=>	$title,
		));
		if($r != false){
			return returnApi(200,'success');
		}else{
			return returnApi(202,'修改数据失败！');
		}
	}

	public function ajaxDel($type){
		// type为1时，删除单条；2时删除关联多条及本条
		$id = I('get.id');
		if($type == 1){
			$r = $this->delete($id);
			if($r){
				return returnApi(200,'success');
			}else{
				return returnApi(201,'删除失败！');
			}
		}else{
			$_r = $this->execute("DELETE FROM `by_trademark_classification` WHERE pid=".$id);
			if($_r){
				$r = $this->execute("DELETE FROM `by_trademark_classification` WHERE id=".$id);
				if($r){
					return returnApi(200,'删除成功！');
				}else{
					return returnApi(203,'删除组下商品项成功，删除商品组失败！');
				}
			}else{
				return returnApi(201,'删除组下商品项失败！');
			}
		}
	}



}