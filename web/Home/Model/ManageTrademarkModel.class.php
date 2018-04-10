<?php 
namespace Home\Model;
use Think\Model;

class ManageTrademarkModel extends Model{




	public function addNew(){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			return returnApi(201,'确认登录','',U('Member/login'));
		}

		// 查找重复
		$has = $this->field('id')->where('regno="%s"',I('post.regno'))->find(); 
		if($has){
			return returnApi(203,'该商标已存在！~');
		}

		// 
		$data['member_uniqid'] = session('uniqid');
		$data['phone'] = session('phone');
		$data['tmcode'] = I('post.tmcode');
		$data['intcls'] = I('post.intcls');
		$data['tmname'] = I('post.tmname');
		$data['regno'] = I('post.regno');
		$data['csggqh'] = I('post.csggqh','');
		$data['tmlaw'] = I('post.tmlaw');
		$data['appdate'] = strtotime(I('post.appdate',''));
		$data['csdate'] = strtotime(I('post.csdate',''));
		$data['regdate'] = strtotime(I('post.regdate',''));
		$data['enddate'] = strtotime(I('post.enddate',''));
		$data['appname'] = I('post.appname','');
		$data['appaddr'] = I('post.appaddr','');
		$data['agentname'] = I('post.agentname','');
		$data['tmimage'] = I('post.tmimage','');
		$data['tmgoods'] = I('post.tmgoods','');
		$data['tmgroup'] = I('post.tmgroup','');
		$data['tmggnum'] = I('post.tmggnum','');
		$data['tmsblx'] = I('post.tmsblx');
		$data['zcggqh'] = I('post.zcggqh','');
		$data['addtime'] = time();

		$r = $this->data($data)->add();
		if($r){
			return returnApi(200,'添加成功！~');
		}else{
			return returnApi(202,'添加失败！');
		}
	}

	public function del(){
		$memberModel = D('Member');
		if($memberModel->truelogin() == false){
			return returnApi(201,'确认登录','',U('Member/login'));
		}

		$tmcode = I('get.tmcode');
		$uniqid = session('uniqid');
		$r = $this->execute("DELETE FROM by_manage_trademark WHERE member_uniqid='".$uniqid."' AND tmcode=".$tmcode);
		// $r = $this->where('member_uniqid="%s" AND tmcode=%d',$uniqid,$tmcode)->delete();
		if($r !== false){
			return returnApi(200,'success');
		}else{
			return returnApi(202,'删除失败！~');
		}
	}

	public function search(){
		// $memberModel = D('Member');
		// if($memberModel->truelogin() == false){
		// 	return returnApi(201,'确认登录','',U('Member/login'));
		// }

		$where = '1=1';

		$tmname = I('post.tmname');
		if($tmname){
			$where .= ' AND tmname LIKE "%'.$tmname.'%" ';
		}

		// 申请日期开始
		$appdate_s = I('post.appdate_s');
		// 申请日期结束
		$appdate_e = I('post.appdate_e');
		if($appdate_e && $appdate_s){
			$where .= ' AND appdate BETWEEN '.$appdate_s.' AND '.$appdate_e.' ';
		}else{
			if($appdate_s){
				$appdate_s = strtotime($appdate_s);
				$where .= ' AND appdate>='.$appdate_s;
			}
			if($appdate_e){
				$appdate_e = strtotime($appdate_e);
				$where .= ' AND appdate<='.$appdate_e;
			}
		}
		
		// 初审日期开始
		$csdate_s = I('post.csdate_s');
		// 初审日期结束
		$csdate_e = I('post.csdate_e');
		if($csdate_s && $csdate_e){
			$where .= ' AND csdate BETWEEN '.$csdate_s.' AND '.$csdate_e.' ';
		}else{
			if($csdate_e){
				$csdate_e = strtotime($csdate_e);
				$where .= ' AND csdate<='.$csdate_e;
			}
			if($csdate_s){
				$csdate_s = strtotime($csdate_s);
				$where .= ' AND csdate>='.$csdate_s;
			}
		}

		// 注册日期开始
		$regdate_s = I('post.regdate_s');
		// 注册日期结束
		$regdate_e = I('post.regdate_e');
		if($regdate_e && $regdate_s){
			$where .= ' AND regdate BETWEEN '.$regdate_s.' AND '.$regdate_e.' ';
		}else{
			if($regdate_s){
				$regdate_s = strtotime($regdate_s);
				$where .= ' AND regdate>='.$regdate_s;
			}
			if($regdate_e){
				$regdate_e = strtotime($regdate_e);
				$where .= ' AND regdate<='.$regdate_e;
			}
		}

        //每页条数
        $pagesize = 10;

        $total = $this->where($where)->count();

		$page = new \Think\AjaxPage($total,$pagesize);

        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');

        //生成翻页字符串
        $show = $page->show();

        $data = $this->field('tmcode,regno,tmname,intcls,appdate,csdate,regdate,enddate,tmlaw')->where($where)->order('addtime DESC')->limit($page->firstRow,$page->listRows)->select();

        if($data){
        	foreach($data as $k=>$v){
        		$data[$k]['appdate'] = date('Y-m-d',$v['appdate']);
        		$data[$k]['csdate'] = date('Y-m-d',$v['csdate']);
        		$data[$k]['regdate'] = date('Y-m-d',$v['regdate']);
        		$data[$k]['enddate'] = date('Y-m-d',$v['enddate']);
        	}
        	return returnApi(200,'success',array(
	        	'data'		=>		$data,
	        	'page'		=>		$show,
	        	'total'		=>		$total,
	        ));
        }
	}
}



