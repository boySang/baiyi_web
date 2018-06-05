<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class GoodsProblemController extends LayoutController {


	public function d($id){
		$m = D('GoodsProblem');
		$d = $m->getOne($id);
		$this->assign(array(
			'data'		=>		$d,
		));
		$this->display();
	}
}