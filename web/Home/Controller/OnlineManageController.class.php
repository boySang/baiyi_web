<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class OnlineManageController extends LayoutController {



	public function ing(){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('login'));
		}
		// 是否付费会员
		if($memberModel->isVip() == false){
			// header('Location:'.U('login'));
			$this->error('您暂无权限进入');
		}
		$this->display();
	}

	public function shangbiaoadd(){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('login'));
		}
		// 是否付费会员
		if($memberModel->isVip() == false){
			// header('Location:'.U('login'));
			$this->error('您暂无权限进入');
		}
		$this->display();
	}

	public function shangbiaosearch(){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			header('Location:'.U('login'));
		}
		// 是否付费会员
		if($memberModel->isVip() == false){
			// header('Location:'.U('login'));
			$this->error('您暂无权限进入');
		}
		$this->display();
	}

	public function login(){
		// var_dump(cookie("uniqid"));
		// var_dump(cookie("phone"));
		$memberModel = D('Member');
		if($memberModel->truelogin() == true){
			header('Location:'.U('ing'));
		}
		$this->display();
	}

}