<?php 
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{



	public function getGoodsOne($id){
		$d = $this->field('goods_name,goods_id,keywords,goods_info,goods_tips,goods_content,goods_thumb,goods_default_price')->find($id);
		$d['goods_thumb'] = getImgOne($d['goods_thumb']);
		$d['goods_content'] = htmlspecialchars_decode($d['goods_content']);
		return $d;
	}

	public function getGoodsToHome($cate_id){
		$d = $this->field('goods_id,goods_name,goods_tips_home,goods_thumb,goods_default_price')->where('cate_id=%d AND is_on_sale=1',$cate_id)->order('home_order DESC')->limit(6)->select();
		if($d){
			foreach($d as $k=>$v){
				$d[$k]['goods_thumb'] = getImgOne($v['goods_thumb']);
				$d[$k]['url'] = geturl('goods',$v['goods_id']);
			}
			return $d;
		}
	}

	// 获取栏目下的商品
	public function getGoodsFromCate($cate_id,$toplace='menu'){
		if($toplace == 'menu'){
			$field = 'goods_id,goods_name';
		}elseif($toplace == 'cateIndex'){
			$field = 'goods_id,goods_name,goods_default_price,goods_tips_home';
		}
		$d = $this->field($field)->where('cate_id=%d',$cate_id)->select();
		if($d){
			foreach($d as $k=>$v){
				$d[$k]['url'] = geturl('goods',$v['goods_id']);
			}
			return $d;
		}
	}

}