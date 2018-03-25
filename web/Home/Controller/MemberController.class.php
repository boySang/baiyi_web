<?php
namespace Home\Controller;
use Home\Controller\LayoutController;

class MemberController extends LayoutController {

	public function index(){
		$this->display();
	}

    public function reg(){
        $this->display();
    }

    public function ajaxReg(){

		header('Content-type:text/json');
		$m = D('Member');
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