<?php 
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{



	public function getGoodsOne($id){
		$d = $this->field('goods_name,goods_id,keywords,goods_info,goods_tips,goods_content,goods_thumb,goods_default_price')->where('is_del=0 AND goods_id=%d',$id)->find();
		if($d){
			$d['goods_thumb'] = getImgOne($d['goods_thumb']);
			$d['goods_content'] = htmlspecialchars_decode($d['goods_content']);
			return $d;
		}
		return false;
	}

	public function getGoodsToHome($cate_id,$limit=6){
		$d = $this->field('goods_id,goods_name,goods_tips_home,goods_thumb,iconfont,goods_default_price')->where('cate_id=%d AND is_on_sale=1',$cate_id)->order('home_order DESC')->limit($limit)->select();
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
		$d = $this->field($field)->where('cate_id=%d AND is_del=0',$cate_id)->order('cate_order DESC')->select();
		if($d){
			foreach($d as $k=>$v){
				$d[$k]['url'] = geturl('goods',$v['goods_id']);
			}
			return $d;
		}
	}

	public function getGoodsInfoToCar($goods_id){
		$d = $this->field('goods_name,goods_default_price')->find($goods_id);
		return $d;
	}

	public function getGoodsName($goods_id){
		$d = $this->field('goods_name')->find($goods_id);
		return $d['goods_name'];
	}

}