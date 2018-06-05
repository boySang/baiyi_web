<?php 
namespace Admin\Model;
use Think\Model;

class MemberModel extends Model{


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

        $data = $this->field('user_id,phone,addtime,vip_state,state')->order('user_id DESC')->limit($page->firstRow,$page->listRows)->select();

        if($data){
        	foreach($data as $k=>$v){
        		if($v['vip_state'] == 1){
        			$data[$k]['vip_text'] = '付费会员';
        		}else{
        			$data[$k]['vip_text'] = '普通会员';
        		}
        		if($v['state'] == 1){
        			$data[$k]['state_text'] = '正常';
        		}else{
        			$data[$k]['state_text'] = '禁止登录';
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