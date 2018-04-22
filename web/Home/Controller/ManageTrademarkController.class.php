<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class ManageTrademarkController extends LayoutController {



	public function addNew(){
		header('Content-type:text/json');
		$m = D('ManageTrademark');
		echo $m->addNew();
	}

	public function del(){
		header('Content-type:text/json');
		$m = D('ManageTrademark');
		echo $m->del();
	}

	public function search(){
		header('Content-type:text/json');
		$m = D('ManageTrademark');
		echo $m->search();
	}
}