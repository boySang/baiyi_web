<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class OnlineManageController extends LayoutController {



	public function ing(){
		$m = D('Member');
		if($m->truelogin() == false){
			header('Location:'.U('login'));
		}
		$this->display();
	}

	public function shangbiaoadd(){
		$m = D('Member');
		if($m->truelogin() == false){
			header('Location:'.U('login'));
		}
		$this->display();
	}

	public function shangbiaosearch(){
		$m = D('Member');
		if($m->truelogin() == false){
			header('Location:'.U('login'));
		}
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