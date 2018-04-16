<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class ExpertsWendaController extends LayoutController {



	public function index(){
		// 获取新闻
		$m = D('ExpertsWenda');
		$data['news'] = $m->getInfo(9,9);
		// 专家观点
		$data['zhuanjia'] = $m->getInfo(1,4);
		$this->assign(array(
			'data'		=>		$data,
		));
		$this->display();
	}

	public function show(){
		// 获取新闻
		$m = D('ExpertsWenda');
		$data['news'] = $m->getInfo(9,9);
		// 专家观点
		$data['zhuanjia'] = $m->getInfo(1,4);
		$this->assign(array(
			'data'		=>		$data,
		));
		$this->display();
	}
}