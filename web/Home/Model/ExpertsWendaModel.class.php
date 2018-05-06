<?php 
namespace Home\Model;
use Think\Model;

class ExpertsWendaModel extends Model{


	public function getInfo($pid,$limit = 0){
		$d = $this->field('id,title,answer,addtime')->where('pid=%d',$pid)->limit($limit)->select();
		foreach($d as $k=>$v){
			$d[$k]['addtime'] = date('Y-m-d',$v['addtime']);
		}
		return $d;
	}

	public function ajaxGetAll(){
		$topNav = $this->getTopNav();
		if(!$topNav){
			return returnApi(201,'获取失败');
		}
		$_temparr = array();
		foreach($topNav as $k=>$v){

			if($v['id'] == (1)){
				unset($topNav[$k]);
				continue;
			}

			if($v['id'] == 9){

				$where = 'pid='.$v['id'];

		        //每页条数
		        $pagesize = 8;

		        $total = $this->where($where)->count();

				$page = new \Think\AjaxPage($total,$pagesize);

		        $page->setConfig('prev','上一页');
		        $page->setConfig('next','下一页');
		        $page->setConfig('first','首页');
		        $page->setConfig('last','末页');

		        //生成翻页字符串
		        $show = $page->show();

		        $data = $this->field('id,title,pid,answer,addtime')->where($where)->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

		        if($data){
		        	foreach($data as $k1=>$v1){
		        		$data[$k1]['url'] = U('ExpertsWenda/detail/id/'.$v['id']);
		        		$data[$k1]['addtime'] = date('Y-m-d',$v1['addtime']);
		        	}
		        	$topNav[$k]['main'] = array(
			        	'data'		=>		$data,
			        	'page'		=>		$show,
			        );
		        }

			}else{

				$where = 'pid='.$v['id'];

		        //每页条数
		        $pagesize = 15;

		        $total = $this->where($where)->count();

				$page = new \Think\AjaxPage($total,$pagesize);

		        $page->setConfig('prev','上一页');
		        $page->setConfig('next','下一页');
		        $page->setConfig('first','首页');
		        $page->setConfig('last','末页');

		        //生成翻页字符串
		        $show = $page->show();

		        $data = $this->field('id,title,pid,answer')->where($where)->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

		        if($data){
		        	$topNav[$k]['main'] = array(
			        	'data'		=>		$data,
			        	'page'		=>		$show,
			        );
		        }
		    }

		}
		foreach($topNav as $k=>$v){
			$_temparr[] = $v;
		}
		return returnApi(200,'success',$_temparr);
	}

	public function getTopNav(){
		return $this->field('id,title')->where('pid=0')->select();
	}
}