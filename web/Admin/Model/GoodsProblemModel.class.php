<?php 
namespace Admin\Model;
use Think\Model;

class GoodsProblemModel extends Model{


	public function getAll(){
		//每页条数
        $pagesize = 15;

        $total = $this->count();

		$page = new \Think\Page($total,$pagesize);

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');

        //生成翻页字符串
        $show = $page->show();

        $data = $this->field('id,title,goods_id')->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

        if($data){
        	$goods_m = D('Goods');
        	foreach($data as $k=>$v){
        		$data[$k]['goods_name'] = $goods_m->getName($v['goods_id']);
        	}
        	return array(
	        	'data'		=>		$data,
	        	'page'		=>		$show,
	        	'total'		=>		$total,
	        );
        }
	}

	public function getOne($id){
		$d = $this->field('id,title,content,goods_id')->find($id);
		$d['content'] = htmlspecialchars_decode($d['content']);
		return $d;
	}
}