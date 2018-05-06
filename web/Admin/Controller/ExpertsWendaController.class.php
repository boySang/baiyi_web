<?php
namespace Admin\Controller;
use Think\Controller;
class ExpertsWendaController extends Controller {




	public function add(){
		$m = D('ExpertsWenda');
    	if(IS_POST){
            if($m->create()) {
            	$m->add() ? $this->redirect('add') : $this->error('添加失败');
            }
        }
        // 获取顶级栏目
        $data = $m->getTopNav();
        $this->assign(array(
        	'data'		=>		$data,
        ));
		$this->display();
	}

	public function show(){
		$m = D('ExpertsWenda');
        $data = $m->getAll();
        $this->assign(array(
        	'data'		=>		$data,
        ));
		$this->display();
	}
}