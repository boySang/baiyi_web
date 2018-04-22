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
    	$web_nav[0]['title'] = '知识产权在线申请';
    	$web_nav[0]['url'] = U('Goods/detail/id/1');
    	$web_nav[1]['title'] = '国际商标预算';
    	$web_nav[1]['url'] = U('InternationalReg/madeli');
    	$web_nav[2]['title'] = '知识产权在线管理';
    	$web_nav[2]['url'] = U('OnlineManage/ing');
    	$web_nav[3]['title'] = '知识产权专家顾问';
    	$web_nav[3]['url'] = U('ExpertsWenda/index');
    	$this->assign(array(
    		'layoutdata'		=>		$layoutdata,
    		'web_name'			=>		'上海百一知识产权代理有限公司',
    		'web_nav'			=>		$web_nav,
    	));

	}





}