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
		$this->display();
	}

	public function ajaxGetAll(){
		header('Content-type:text/json');
		$m = D('ExpertsWenda');
		echo $m->ajaxGetAll();
	}

	public function ajaxGetPageNews(){
		header('Content-type:text/json');
		$m = D('ExpertsWenda');
		echo $m->ajaxGetPageNews();
	}

	public function detail($id){
		if(!is_numeric($id)){
			$this->error('参数错误');
		}
		$m = D('ExpertsWenda');
		if(F('ExpertsWendaDetailId_'.$id)){
			$data = F('ExpertsWendaDetailId_'.$id);
		}else{
			$data = $m->getOne($id);
			F('ExpertsWendaDetailId_'.$id,$data);
		}
		$this->assign(array(
			'data'			=>			$data,
		));
		$this->display();
	}
}