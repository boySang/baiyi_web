<?php
namespace Admin\Controller;
use Think\Controller;
class OptAttrValController extends Controller {



	public function show(){
		$m = D('OptAttrVal');
    	$data = $m->getAll(I('get.attr_id'));
    	$this->assign(array(
    		'data'	=>		$data,
		));
		$this->display();
	}

	public function add(){
		$m = D('OptAttrVal');
		if(IS_POST){
            if($m->create()) {
                $m->add() ? header('Location:'.I('post.prev_url')) : $this->error('添加失败');
            }else{
                $this->error($m->getError());
            }
        }
        $optAttrModel = D('OptAttr');
        $attr_name = $optAttrModel->getName(I('get.attr_id'));
        $this->assign(array(
        	'attr_name'		=>		$attr_name,
        ));
		$this->display();
	}

	public function update($id){
    	$m = D('OptAttrVal');
        if(IS_POST){
            if($m->create()) {
                $m->save() !== false ? header('Location:'.I('post.prev_url')) : $this->error('修改失败');
            }else{
                $this->error($m->getError());
            }
        }
        //获取该id信息
        $data = $m->find($id);
        $optAttrModel = D('OptAttr');
        $attr_name = $optAttrModel->getName($data['attr_id']);
        $this->assign(array(
        	'data'			=>		$data,
        	'attr_name'		=>		$attr_name,
        ));
        $this->display();
    }
}