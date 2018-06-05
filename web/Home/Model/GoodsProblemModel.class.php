<?php 
namespace Home\Model;
use Think\Model;

class GoodsProblemModel extends Model{


	public function getFromGoodsId($goods_id){
		$d = $this->field('id,title')->where('goods_id=%d',$goods_id)->order('id DESC')->select();
		foreach($d as $k=>$v){
			$d[$k]['url'] = U('GoodsProblem/d/id/'.$v['id']);
		}
		return $d;
	}

	public function getOne($id){
		$d = $this->field('id,title,content,goods_id')->find($id);
		$goods_m = D('Goods');
		$d['goods_name'] = $goods_m->getGoodsName($d['goods_id']);
		$d['content'] = htmlspecialchars_decode($d['content']);
		return $d;
	}
}