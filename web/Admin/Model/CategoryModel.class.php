<?php 
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model{


	public function getAll(){

		$d = $this->field('id,title')->select();
		return $d;
	}
}