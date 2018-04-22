<?php
namespace Admin\Controller;
use Think\Controller;
class ConnectIndustryController extends Controller {


	public function add(){
		$m = D('ConnectIndustry');
		if(IS_POST){
            if($m->create()) {
                $m->add() ? header('Location:'.U('show')) : $this->error('添加失败');
            }else{
                $this->error($m->getError());
            }
        }
        $data = $m->getAllFromPid(0);
		$this->assign(array(
			'data'		=>		$data,
		));
		$this->display();
	}

	public function show(){
		$m = D('ConnectIndustry');
		$data = $m->getAll();
		$this->assign(array(
			'data'		=>		$data,
		));
		$this->display();
	}

	public function update($id){
		$m = D('ConnectIndustry');
		if(IS_POST){
            if($m->create()) {
                $m->save() !== false ? header('Location:'.U('show')) : $this->error('修改失败');
            }else{
                $this->error($m->getError());
            }
        }
		$data = $m->getOne($id);
        $pidData = $m->getAllFromPid(0);
		$this->assign(array(
			'data'		=>		$data,
			'pidData'	=>		$pidData,
		));
		$this->display();
	}

	public function getConnectVal(){
		header('Content-type:text/json');
		$m = D('ConnectIndustry');
		echo $m->getConnectVal();
	}
}