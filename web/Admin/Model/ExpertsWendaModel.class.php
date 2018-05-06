<?php 
namespace Admin\Model;
use Think\Model;

class ExpertsWendaModel extends Model{

	public function getTopNav(){
		$d = $this->field('id,title')->where('pid=0')->select();
		return $d;
	}

	public function getAll(){

        //每页条数
        $pagesize = 10;

        $total = $this->where('pid!=0')->count();

		$page = new \Think\Page($total,$pagesize);

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');

        //生成翻页字符串
        $show = $page->show();

        $data = $this->field('id,title,pid,state')->where('pid!=0')->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

        if($data){
        	foreach($data as $k=>$v){
        		$data[$k]['cateName'] = $this->getTitle($v['pid']);
        	}
        	return array(
	        	'data'		=>		$data,
	        	'page'		=>		$show,
	        	'total'		=>		$total,
	        );
        }
	}

	public function getTitle($pid){
		$d = $this->field('title')->where('id=%d',$pid)->find();
		return $d['title'];
	}

    protected function _before_insert(&$data, $options){
    	$data['addtime'] = time();
    }
}