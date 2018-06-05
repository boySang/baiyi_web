<?php 
namespace Admin\Model;
use Think\Model;

class OrderDetailModel extends Model{




	public function getFromUniqid($uniqid){
		//每页条数
        $pagesize = 10;

        $total = $this->where('member_uniqid="%s"',$uniqid)->count();

		$page = new \Think\Page($total,$pagesize);

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');

        //生成翻页字符串
        $show = $page->show();

		$data = $this->field('goods_name,id,member_uniqid,total_price,addtime,state,uniquenum,contract_number')->where('member_uniqid="%s"',$uniqid)->order('id DESC')->limit($page->firstRow,$page->listRows)->select();

        if($data){
        	foreach($data as $k=>$v){
				$data[$k]['total_price'] = $v['total_price']/100;
				$data[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
				if($v['state'] == 101){
					$data[$k]['state_text'] = '已付款';
				}elseif($v['state'] == 102){
					$data[$k]['state_text'] = '已上传资料';
				}elseif($v['state'] == 103){
					$data[$k]['state_text'] = '已完成';
				}elseif($v['state'] == 104){
					$data[$k]['state_text'] = '已邮寄';
				}elseif($v['state'] == 201){
					$data[$k]['state_text'] = '未付款';
				}elseif($v['state'] == 202){
					$data[$k]['state_text'] = '未上传资料';
				}elseif($v['state'] == 203){
					$data[$k]['state_text'] = '未下载合同并上传合同';
				}elseif($v['state'] == 204){
					$data[$k]['state_text'] = '未邮寄';
				}
			}
        	return array(
	        	'data'		=>		$data,
	        	'page'		=>		$show,
	        	'total'		=>		$total,
	        );
        }
	}
}