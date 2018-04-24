<?php
namespace Home\Controller;
use Home\Controller\LayoutController;

class MemberController extends LayoutController {

	public function index(){
		// var_dump(session('notify_pay'));
		$m = D('Member');
		if($m->truelogin() == false){
			header('Location:'.U('login'));
		}
		$this->display();
	}

    public function reg(){
    	$m = D('Member');
		if($m->truelogin()){
			header('Location:'.U('Index/index'));
		}
        $this->display();
    }

    public function ajaxReg(){
		header('Content-type:text/json');
		$m = D('Member');
		if($m->truelogin()){
			echo returnApi(201,'已经登录！');
		}
		echo $m->ajaxReg();
    }

    public function chkPhone(){
		$m = D('Member');
		echo $m->chkPhone() == true? false: true;
    }

    public function regSuccess(){
    	$this->display();
    }

    public function login(){
    	// var_dump(session('uniqid'));
    	// var_dump(session('phone'));
    	// var_dump(cookie('uniqid'));
    	// var_dump(cookie('phone'));
    	$m = D('Member');
		if($m->truelogin()){
			header('Location:'.U('Index/index'));
		}
    	$this->display();
    }

    public function ajaxLogin(){
		header('Content-type:text/json');
    	$m = D('Member');
		echo $m->ajaxLogin();
    }

    public function ajaxManageLogin(){
    	header('Content-type:text/json');
    	$m = D('Member');
		echo $m->ajaxManageLogin();
    }

    public function ajacChkState(){
		header('Content-type:text/json');
		$m = D('Member');
		if($m->truelogin() == true){
			echo returnApi(200,'logined');
		}else{
			echo returnApi(201,'notlogin');
		}
    }

    public function logout(){
    	$m = D('Member');
    	if($m->logout()){
    		header('Location:'.U('Index/index'));
    	}else{
    		$this->error('退出失败！');
    	}
    }

    // 官文页面
    public function guanwen(){
    	$this->display();
    }

    // 发票页面
    public function fapiao(){
    	$this->display();
    }

    // 安全管理页面
    public function safe(){
    	$this->display();
    }


}