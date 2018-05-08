<?php 
namespace Home\Model;
use Think\Model;

class ExpertsWendaModel extends Model{


	public function getInfo($pid,$limit = 0){
		$d = $this->field('id,title,answer,addtime')->where('pid=%d',$pid)->limit($limit)->select();
		foreach($d as $k=>$v){
			$d[$k]['addtime'] = date('Y-m-d',$v['addtime']);
			if($pid == 9){
				$d[$k]['url'] = U('ExpertsWenda/detail/id/'.$v['id']);
			}
		}
		return $d;
	}

	public function ajaxGetAll(){
		$topNav = $this->getTopNav();
		if(!$topNav){
			return returnApi(201,'获取失败');
		}
		if(F('ExpertsWendaAllArticle')){
			$_temparr = F('ExpertsWendaAllArticle');
		}else{
			$_temparr = array();
			foreach($topNav as $k=>$v){

				if($v['id'] == (1)){
					unset($topNav[$k]);
					continue;
				}

		        //每页条数
		        $pagesize = 8;

		        $total = $this->where('pid=%d',$v['id'])->count();

				$page = new \Think\AjaxPage($total,$pagesize);

		        $page->setConfig('prev','上一页');
		        $page->setConfig('next','下一页');
		        $page->setConfig('first','首页');
		        $page->setConfig('last','末页');

		        //生成翻页字符串
		        $show = $page->show();

		        $data = $this->field('id,title,pid,answer,addtime')->where('pid=%d',$v['id'])->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

		        if($data){
					if($v['id'] == 9){
			        	foreach($data as $k1=>$v1){
			        		$data[$k1]['url'] = U('ExpertsWenda/detail/id/'.$v1['id']);
			        		$data[$k1]['addtime'] = date('Y-m-d',$v1['addtime']);
			        	}
			        }
		        	$topNav[$k]['main'] = array(
			        	'data'		=>		$data,
			        	'page'		=>		$show,
			        );
		        }


			}
			foreach($topNav as $k=>$v){
				$_temparr[] = $v;
			}
			F('ExpertsWendaAllArticle',$_temparr);
		}
		return returnApi(200,'success',$_temparr);
	}

	public function ajaxGetPageNews(){
		$articletype = I('get.articletype');
		if(!is_numeric($articletype)){
			return returnApi(201,'参数错误');
		}

		if(F('ExpertsWendaAllArticleFromid_'.$articletype.'_p_'.I('get.p'))){
			$_data = F('ExpertsWendaAllArticleFromid_'.$articletype.'_p_'.I('get.p'));
			if($_data){
				if($articletype == 9){
	        		$state = 20000;
				}else{
	        		$state = 30000;
				}
				$msg = 'success';
	        }else{
				if($articletype == 9){
	        		$state = 20001;
				}else{
	        		$state = 30001;
				}
	        	$msg = '未查询到数据';
	        }
		}else{

	        //每页条数
	        $pagesize = 8;

	        $total = $this->where('pid=%d',$articletype)->count();

			$page = new \Think\AjaxPage($total,$pagesize);

	        $page->setConfig('prev','上一页');
	        $page->setConfig('next','下一页');
	        $page->setConfig('first','首页');
	        $page->setConfig('last','末页');

	        //生成翻页字符串
	        $show = $page->show();

	        $data = $this->field('id,title,pid,answer,addtime')->where('pid=%d',$articletype)->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

	        if($data){
				if($articletype == 9){
		        	foreach($data as $k=>$v){
		        		$data[$k]['url'] = U('ExpertsWenda/detail/id/'.$v['id']);
		        		$data[$k]['addtime'] = date('Y-m-d',$v['addtime']);
		        	}
	        		$state = 20000;
				}else{
	        		$state = 30000;
				}
				$msg = 'success';
	        	$_data['data'] = $data;
	        	$_data['page'] = $show;
	        }else{
				if($articletype == 9){
	        		$state = 20001;
				}else{
	        		$state = 30001;
				}
	        	$msg = '未查询到数据';
	        }
	        F('ExpertsWendaAllArticleFromid_'.$articletype.'_p_'.I('get.p'),$_data);
			$_data = F('ExpertsWendaAllArticleFromid_'.$articletype.'_p_'.I('get.p'));
	    }
        return returnApi($state,$msg,$_data);
	}

	public function getOne($id){
		$d = $this->field('id,title,pid,answer,addtime')->find($id);
		$d['pidname'] = $this->getTitle($d['pid']);
		$d['addtime'] = date('Y-m-d',$d['addtime']);
		$d['answer'] = htmlspecialchars_decode($d['answer']);
		return $d;
	}

	public function getTitle($pid){
		$d = $this->field('title')->where('id=%d',$pid)->find();
		return $d['title'];
	}

	public function getTopNav(){
		return $this->field('id,title')->where('pid=0')->select();
	}
}