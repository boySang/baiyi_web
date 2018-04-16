<?php
namespace Admin\Controller;
use Think\Controller;
class ExpertsWendaController extends Controller {




	public function add(){
		$model = D('ExpertsWenda');
    	if(IS_POST){
            if($model->create()) {
            	$model->add() ? $this->redirect('add') : $this->error('添加失败');
            }
        }
        // 获取顶级栏目
        $data = $model->getTopNav();
        $this->assign(array(
        	'data'		=>		$data,
        ));
		$this->display();
	}

	public function show(){
		$this->display();
	}
}