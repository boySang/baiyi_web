<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class TrademarkClassificationController extends LayoutController {



	public function ajaxGetAllFromPid(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxGetAllFromPid();
	}
}