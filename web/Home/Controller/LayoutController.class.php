<?php
namespace Home\Controller;
use Think\Controller;
class LayoutController extends Controller {


	public function __construct(){
		parent::__construct();

		// 获取下拉菜单
		$cateModel = D('Category');
    	$layoutcateMenu = $cateModel->getMenuPublic(true);
    	// var_dump($layoutcateMenu);
    	$layoutdata['menu'] = $layoutcateMenu;
    	$this->assign(array(
    		'layoutdata'		=>		$layoutdata,
    		'web_name'			=>		'上海百一知识产权代理有限公司',
    	));

	}





}