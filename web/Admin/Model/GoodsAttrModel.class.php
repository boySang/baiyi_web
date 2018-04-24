<?php 
namespace Admin\Model;
use Think\Model;

class GoodsAttrModel extends Model{


	public function getAll($goods_id){
		$d = $this->field('attrval,attr_price')->where('goods_id=%d',$goods_id)->select();
		if($d){
			$str = '';
			foreach($d as $k=>$v){
				$price = $v['attr_price']/100;
				$arr = explode(',',$v['attrval']);
				$optAttrModel = D('optAttr');
				$optAttrValModel = D('optAttrVal');
				foreach($arr as $k1=>$v1){
					$valName = $optAttrValModel->getName($v1);
					$attrName = $optAttrValModel->getPName($v1);
					$str .= $attrName.'：'.$valName.'&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				$str .= '价格：'.$price.' 元 <br />';
			}
			return $str;
		}else{
			return false;
		}
	}

	public function delFromGoodsId($goods_id){
		$d = $this->execute("DELETE FROM by_goods_attr WHERE goods_id=".$goods_id);
	}

	

}