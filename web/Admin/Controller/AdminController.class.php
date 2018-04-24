<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {


    public function login(){
        $this->display();
    }

    public function ajaxLogin(){
    	header('Content-Type:text/json');
    	$m = D('Admin');
    	echo $m->ajaxLogin();
    }
}