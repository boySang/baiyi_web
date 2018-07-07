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

    public function dataCount(){
    	$this->display();
    }

    public function getDataTotal(){
    	header('Content-type:text/json');

    	$data['goods']['total'] = 32;
    	$data['goods']['sell'] = 32;
    	$data['goods']['down'] = 0;
    	$data['goods']['del'] = 0;

    	$data['member']['today'] = 12;
    	$data['member']['yestoday'] = 10;
    	$data['member']['vip'] = 236;
    	$data['member']['total'] = 340;

    	$data['order']['today'] = 8;
    	$data['order']['yestoday'] = 6;
    	$data['order']['onemonth'] = 205;
    	$data['order']['total'] = 590;
    	echo returnApi(200,'success',$data);
    }


}
