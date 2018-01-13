<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {


	//构造方法,登陆的时候用
    public function __construct()
    {
        parent::__construct();
        if(!session('auth') && !session('name')){
            $this->redirect("Admin/Admin/login");
        }
    }

    public function index(){
        $this->display();
    }

    public function wellcome(){
    	$this->display();
    }


}