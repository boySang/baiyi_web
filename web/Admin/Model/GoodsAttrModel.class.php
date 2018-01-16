<?php 
namespace Admin\Model;
use Think\Model;

class GoodsAttrModel extends Model{


	public function getAll($goods_id){
		$d = $this->query('
			SELECT 
					a.attr_price,b.name attr_name,c.name attr_val_name
			FROM
					by_goods_attr a,by_opt_attr b,by_opt_attr_val c 
			WHERE
					a.goods_id='.$goods_id.' AND a.attr=b.id AND a.attrval=c.id

		');
		if($d){
			return $d;
		}else{
			return false;
		}
	}
}