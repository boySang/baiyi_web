<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class InternationalRegController extends LayoutController {



	public function madeli(){
		$this->display();
	}

	public function ajaxGetCountry(){
		header('Content-type:text/json');
		$m = D('InternationalReg');
		echo $m->ajaxGetCountry();
	}
}