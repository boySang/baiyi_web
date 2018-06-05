<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends Controller {


	public function show(){
		$m = D('Member');
		$data = $m->getAll();
		$this->assign(array(
			'data'			=>			$data,
		));
		$this->display();
	}
}