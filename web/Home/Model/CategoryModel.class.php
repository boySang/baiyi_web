<?php 
namespace Home\Model;
use Think\Model;

class CategoryModel extends Model{



	public function getMenuPublic($tocate = false){
		if($tocate){
			$bigtitLimit = 5;
		}else{
			$bigtitLimit = 0;
		}
		$d = $this->field('id,title,urlname')->limit($bigtitLimit)->order('sort desc')->select();
		$goodsModel = D('Goods');
		foreach($d as $k=>$v){
			$d[$k]['goods'] = $goodsModel->getGoodsFromCate($v['id']);
			if($tocate){
				foreach($d[$k]['goods'] as $k1=>$v1){
					if($k1 < 3){
						$d[$k]['goods_limit'][$k1] = $v1;
					}
				}
			}
			if($v['id'] == 5){
				$d[$k]['url'] = 'javascript:;';
			}else{
				$d[$k]['url'] = geturl('category',$v['id']);
			}
		}
		return $d;
	}

	public function getInfo($id){
		$d = $this->field('pic,title')->find($id);
		$d['pic'] = getImgOne($d['pic']);
		return $d;
	}



}