<?php 
namespace Admin\Model;
use Think\Model;

class OptAttrModel extends Model{


	public function getAll(){

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
		$data = $this->order('id ASC')->limit($page->firstRow,$page->listRows)->select();
		if($data){
			$OptAttrValModel = D('OptAttrVal');
			foreach($data as $k=>$v){
				$data[$k]['val'] = $OptAttrValModel->getAll($v['id'],'str');
			}
		}
		//返回翻页字符串和数据
		return array(
			'data'=>$data,
			'page'=>$show,
			'total'=>$total,
		);
	}

	public function goodsGetAll(){
		$d = $this->select();
		// 获取第一个属性的值
		$OptAttrValModel = D('OptAttrVal');
		$val = $OptAttrValModel->getAll($d[0]['id']);
		return array(
			'attr'		=>		$d,
			'firstval'	=>		$val['data'],
		);
	}

	public function getName($id){
		$d = $this->field('name')->find($id);
		return $d['name'];
	}

	protected function _before_delete(&$data, $options){
		// 删除分类之前，检测分类属性，有的话就删除
		$optAttrValModel = D('OptAttrVal');
		$optAttrValData = $optAttrValModel->isHas($data['where']['id']);
		if($optAttrValData){
			// 删除所有的属性
			$optAttrValModel->delFromAttrId($data['where']['id']);
		}
	}


}