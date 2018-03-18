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

	public function ajaxGetOneFromId(){
		header('Content-type:text/json');
		$m = D('ConnectIndustry');
		echo $m->ajaxGetOneFromId();
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

	
    // 用户自助选择商品项后，确认的页面
    public function zizhu_confirm(){
    	$this->display();
    }
}