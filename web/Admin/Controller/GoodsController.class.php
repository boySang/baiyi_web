<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {


	public function show(){
		$m = D('Goods');
    	$data = $m->getAll();
    	$this->assign(array(
    		'data'	=>		$data,
		));
		$this->display();
	}

	public function add(){

		$cateModel = D('Category');
		$cate = $cateModel->getAll();
		// 获取属性
		$optAttrModel = D('optAttr');
		$optAttrData = $optAttrModel->goodsGetAll();
		$this->assign(array(
			'cate'			=>		$cate,
			'optAttrData'	=>		$optAttrData,
		));
		$this->display();
	}

	public function ajaxAdd(){
		header('Content-type:text/json');
		$m = D('Goods');
		echo $m->ajaxAdd();
	}

	public function del($id){
		$m = D('Goods');
		$m->delete($id) != false? header('Location:'.PREV_URL): $this->error('删除失败');
	}

	public function todel(){
		header('Content-type:text/json');
		$m = D('Goods');
		echo $m->todel();
	}
}