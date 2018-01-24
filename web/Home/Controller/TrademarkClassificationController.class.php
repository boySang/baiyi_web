<?php
namespace Home\Controller;
use Think\Controller;
class TrademarkClassificationController extends Controller {



	public function ajaxGetAllFromPid(){
		header('Content-type:text/json');
		$m = D('TrademarkClassification');
		echo $m->ajaxGetAllFromPid();
	}
}