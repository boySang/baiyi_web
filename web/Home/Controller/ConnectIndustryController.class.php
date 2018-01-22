<?php
namespace Home\Controller;
use Think\Controller;
class ConnectIndustryController extends Controller {

	public function aiplan(){
		$m = D('ConnectIndustry');
		$type = $m->getAll();
		$this->assign(array(
			'type'		=>		$type,
		));
		$this->display();
	}

	public function ajaxGetAll(){
		header('Content-type:text/json');
		$m = D('ConnectIndustry');
		echo $m->ajaxGetAll();
	}

	public function selectgoods(){
		$m = D('ConnectIndustry');
		$type = $m->getAll();
		$this->assign(array(
			'type'		=>		$type,
		));
		$this->display();
	}

	public function ipsearch(){
		$this->display();
	}
}