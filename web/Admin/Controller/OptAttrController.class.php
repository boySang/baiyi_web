<?php
namespace Admin\Controller;
use Think\Controller;
class OptAttrController extends Controller {



	public function show(){
		try{
			$m = D('OptAttr');
	    	$data = $m->getAll();
	    	$this->assign(array(
	    		'data'	=>		$data,
			));
			$this->display();
		}catch(Exception $e){
			print $e->getMessage();
			exit();
		}
	}

	public function add(){
		if(IS_POST){
			$m = D('OptAttr');
            if($m->create()) {
                $m->add() ? header('Location:'.I('post.prev_url')) : $this->error('添加失败');
            }else{
                $this->error($m->getError());
            }
        }
		$this->display();
	}

	public function update($id){
    	$m = D('OptAttr');
        if(IS_POST){
            if($m->create()) {
                $m->save() !== false ? header('Location:'.I('post.prev_url')) : $this->error('修改失败');
            }else{
                $this->error($m->getError());
            }
        }
        //获取该id信息
        $data = $m->find($id);
        $this->assign(array(
        	'data'	=>	$data,
        ));
        $this->display();
    }

	public function del($id){
    	$m = D('OptAttr');
        $m->delete($id) ? header('Location:'.PREV_URL) : $this->error('删除失败!');
    }




}