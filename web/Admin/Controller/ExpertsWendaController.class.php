<?php
namespace Admin\Controller;
use Think\Controller;
class ExpertsWendaController extends Controller {




	public function add(){
		$model = D('ExpertsWenda');
    	if(IS_POST){
            $model->add() ? $this->redirect('add') : $this->error('添加失败');
        }
		$this->display();
	}

	public function show(){
		$this->display();
	}
}