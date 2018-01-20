<?php
namespace Admin\Controller;
use Think\Controller;
class TrademarkClassificationController extends Controller {


	public function add(){
		if(IS_POST){
			$m = D('TrademarkClassification');
            if($m->create()) {
                $m->add() ? header('Location:'.U('add')) : $this->error('添加失败');
            }else{
                $this->error($m->getError());
            }
        }

		$this->display();
	}

	public function show(){

		$this->display();
	}

	public function ajaxGetAll(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxGetAll();
	}

	public function ajaxAddGroup(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxAddGroup();
	}

	public function ajaxUpdateGroup(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxUpdateGroup();
	}

	public function ajaxDel($type = 1){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxDel($type);
	}
}