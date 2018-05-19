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

	// 专利案件查询
	public function patent_case_search(){
		$this->display();
	}

	// 案件流程——进行中
	public function patent_case_process_ing(){
		$this->display();
	}

	// 案件流程——已完成
	public function patent_case_process_complated(){
		$this->display();
	}

	// 专利年费管理
	public function patent_moneyyears(){
		$this->display();
	}

	// 专利年费管理 异常
	public function patent_money_error(){
		$this->display();
	}

}