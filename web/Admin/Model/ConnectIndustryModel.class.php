<?php 
namespace Admin\Model;
use Think\Model;

class ConnectIndustryModel extends Model{


	public function getAll(){
		//每页条数
		$pagesize = 15;

		//获取总条数
		$total = $this->where('state=0')->count();

		//生成翻页对象
		$page = new \Think\Page($total,$pagesize);

		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');

		//生成翻页字符串
		$show = $page->show();
		//生成翻页的数据
		$data = $this->field('id,title')->where('pid=0')->order('id ASC')->limit($page->firstRow,$page->listRows)->select();
		if($data){
			foreach($data as $k=>$v){
				$_child = array();
				$child = $this->field('title')->where('state=1 AND pid=%d',$v['id'])->select();
				foreach($child as $k1=>$v1){
					$_child[$k1] = $v1['title'];
				}
				$data[$k]['child'] = implode('、', $_child);
			}
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

	public function getAllFromPid($pid){
		$d = $this->field('id,title')->where('pid=%d',$pid)->select();
		return $d;
	}

	public function getOne($id){
		$d = $this->field('id,title,pid,connect_val')->find($id);
		return $d;
	}

	public function getConnectVal(){
		$id = I('get.id');
		$_d = $this->field('id,title,connect_val')->where('pid=%d',$id)->select();
		$m = D('TrademarkClassification');
		$data = array();
		foreach($_d as $k=>$v){
			$data[$k]['id'] = $v['id'];
			$data[$k]['title'] = $v['title'];
			$data[$k]['connect_val'] = $m->getArrData($v['connect_val']);
		}
		if($data){
			return returnApi(200,'读取成功',$data);
		}else{
			return returnApi(201,'未查询到商品项，请先添加');
		}
	}

	protected function _before_update(&$data, $options){
		if(mb_strlen($data['connect_val'],'utf8') > 0){
			$data['connect_val'] = mb_substr($data['connect_val'],0,mb_strlen($data['connect_val'],'utf8'),'utf-8');
		}else{
			unset($data['connect_val']);
		}
	}






}