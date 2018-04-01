<?php
namespace Home\Controller;
use Home\Controller\LayoutController;

class MemberController extends LayoutController {

	public function index(){
		$m = D('Member');
		if($m->truelogin() == false){
			header('Location:'.U('login'));
		}
		$this->display();
	}

    public function reg(){
    	$m = D('Member');
		if($m->truelogin()){
			header('Location:'.U('index'));
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
    	var_dump(session('uniqid'));
    	var_dump(session('phone'));
    	var_dump(cookie('uniqid'));
    	var_dump(cookie('phone'));
    	$m = D('Member');
		if($m->truelogin()){
			header('Location:'.U('Member/index'));
		}
    	$this->display();
    }

    public function ajaxLogin(){
		header('Content-type:text/json');
    	$m = D('Member');
		echo $m->ajaxLogin();
    }

    // 官文页面
    public function guanwen(){
    	$this->assign(array(
    		'active'		=>		true,
    	));
    	$this->display();
    }
}