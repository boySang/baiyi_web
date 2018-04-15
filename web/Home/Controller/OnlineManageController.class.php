<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class OnlineManageController extends LayoutController {



	public function ing(){
		$this->display();
	}

	public function shangbiaoadd(){
		$this->display();
	}

	public function shangbiaosearch(){
		$this->display();
	}

	public function login(){
		// var_dump(cookie("uniqid"));
		// var_dump(cookie("phone"));
		$m = D('Member');
		if($m->truelogin() == true){
			header('Location:'.U('ing'));
		}
		$this->display();
	}

}