<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsProblemController extends Controller {



	public function add(){
		$m = D('GoodsProblem');
		if(IS_POST){
            if($m->create()) {
            	$m->add() ? $this->redirect('show') : $this->error('添加失败');
            }
        }
		$goods_m = D('Goods');
		$goods_d = $goods_m->getList();
		$this->assign(array(
			'goods'		=>		$goods_d,
		));
		$this->display();
	}

	public function show(){
		$m = D('GoodsProblem');
		$d = $m->getAll();
		$this->assign(array(
			'data'		=>		$d,
		));
		$this->display();
	}

	public function update($id){
		$m = D('GoodsProblem');
		if(IS_POST){
            if($m->create()) {
            	$m->save() !==false ?header('Location:'.I('post.prev_url')) : $this->error('修改失败');
            }
        }
		$goods_m = D('Goods');
		$goods_d = $goods_m->getList();
		$data = $m->getOne($id);
		$this->assign(array(
			'goods'		=>		$goods_d,
			'data'		=>		$data,
		));
		$this->display();
	}

	public function del($id){
		$m = D('Goods');
		$m->delete($id) !== false ? header('Location:'.PREV_URL):$this->error('删除失败');
	}
}