<?php
namespace Admin\Controller;
use Think\Controller;
class CountryController extends Controller {


	public function add(){
		$m = D('Country');
		if(IS_POST){
            if($m->create()) {
                $m->add() ? header('Location:'.U('add')) : $this->error('添加失败');
            }else{
                $this->error($m->getError());
            }
        }
		$this->display();
	}


	public function show(){
		$m = D('Country');
		$d = $m->getAll();
		$this->assign(array(
			'data'		=>		$d,
		));
		$this->display(); 
	}
}