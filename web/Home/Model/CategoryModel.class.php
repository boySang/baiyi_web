<?php 
namespace Home\Model;
use Think\Model;

class CategoryModel extends Model{



	public function getMenuPublic(){
		$d = $this->field('id,title,urlname')->select();
		$goodsModel = D('Goods');
		foreach($d as $k=>$v){
			$d[$k]['goods'] = $goodsModel->getGoodsFromCate($v['id']);
			$d[$k]['url'] = geturl('category',$v['id']);
		}
		return $d;
	}

	public function getInfo($id){
		$d = $this->field('pic,title')->find($id);
		$d['pic'] = getImgOne($d['pic']);
		return $d;
	}



}