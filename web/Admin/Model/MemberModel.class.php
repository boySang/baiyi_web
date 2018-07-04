<?php 
namespace Admin\Model;
use Think\Model;

class MemberModel extends Model{


	public function getAll(){
		//每页条数
        $pagesize = 15;

        //当前页
        if(I('get.p') == null) {
              $nowpage = 0;
        }else{
              $nowpage = I('get.p')-1;
        }
        //翻页重新计数时候用的
        $num = $pagesize * $nowpage;

        $total = $this->count();

		$page = new \Think\Page($total,$pagesize);

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');

        //生成翻页字符串
        $show = $page->show();

        $data = $this->field('user_id,phone,addtime,vip_state,nickname,state,uniqid')->order('user_id DESC')->limit($page->firstRow,$page->listRows)->select();

        if($data){
        	foreach($data as $k=>$v){
        		if($v['vip_state'] == 1){
        			$data[$k]['vip_text'] = '<font color="red">付费会员</font>';
        		}else{
        			$data[$k]['vip_text'] = '普通会员';
        		}
        		if($v['state'] == 1){
        			$data[$k]['state_text'] = '正常';
        		}else{
        			$data[$k]['state_text'] = '禁止登录';
        		}
        		$data[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
        	}
        	return array(
	        	'data'		=>		$data,
	        	'page'		=>		$show,
	        	'total'		=>		$total,
	        	'num'		=>		$num,
	        );
        }
	}

	public function getInfoFromUniqid($uniqid){
		return $this->field('phone,nickname,vip_state,state')->where('uniqid="%s"',$uniqid)->find();
	}
}