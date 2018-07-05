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

    	$data['goods']['total'] = 23;
    	$data['goods']['sell'] = 23;
    	$data['goods']['down'] = 23;
    	$data['goods']['del'] = 23;

    	$data['member']['today'] = 23;
    	$data['member']['yestoday'] = 23;
    	$data['member']['vip'] = 23;
    	$data['member']['total'] = 23;

    	$data['order']['today'] = 23;
    	$data['order']['yestoday'] = 23;
    	$data['order']['onemonth'] = 23;
    	$data['order']['threemonth'] = 23;
    	echo returnApi(200,'success',$data);
    }


}