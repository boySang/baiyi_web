<?php 
namespace Home\Model;
use Think\Model;

class CountryModel extends Model{




	public function getCountrys($where = '1'){
		$d = $this->field('title,id,continent,first_letter,is_alone,is_alone,madeli_model,madeli_one,madeli_two,madeli_three,madeli_eachadd,madeli_topnums')->where($where.' AND state=1')->order('first_letter ASC')->select();
		if($d){
			return $d;
		}
	}





}