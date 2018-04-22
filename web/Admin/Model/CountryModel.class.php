<?php 
namespace Admin\Model;
use Think\Model;

class CountryModel extends Model{


	public function getAll(){
		$where = '1';
		//每页条数
		$pagesize = 15;

		//获取总条数
		$total = $this->where($where)->count();

		//生成翻页对象
		$page = new \Think\Page($total,$pagesize);

		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');

		//生成翻页字符串
		$show = $page->show();
		//生成翻页的数据
		$data = $this->field('id,title,continent,is_madeli,is_danduguojia,is_oumeng,state')->where($where)->order('id ASC')->limit($page->firstRow,$page->listRows)->select();
		if($data){
			//返回翻页字符串和数据
			return array(
				'data'=>$data,
				'page'=>$show,
				'total'=>$total,
			);
		}else{
			return false;
		}
	}
}