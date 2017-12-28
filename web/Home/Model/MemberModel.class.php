<?php 
namespace Home\Model;
use Think\Model;

class MemberModel extends Model{



	public function ajaxReg(){
		$phone = I('post.phone');
		$paswd = I('post.paswd');
		$confirmpaswd = I('post.confirmpaswd');
		if(($phone == '') || ($paswd == '') || ($confirmpaswd == '')){
			return returnApi(201,'字段不能为空');
		}
		if($paswd !== $confirmpaswd){
			return returnApi(201,'密码不一致');
		}
		$data['phone'] = $phone;
		$data['paswd'] = md5($paswd);
		$data['uniqid'] = md5(time().$phone.uniqid());
		if($this->add($data)){
			return returnApi(200,'恭喜！注册成功');
		}else{
			return returnApi(202,'注册失败，请联系客服');
		}
	}

	public function ajaxLogin(){
		$d = $this->field('uniqid,nickname,face,state')->where('phone="%s" AND paswd="%s"',I('post.phone'),md5(I('post.paswd')))->find();
		if(!$d['uniqid']){
			return returnApi(202,'账号或密码不正确!');
		}
		if($d['state'] == 0){
			return returnApi(202,'该用户禁止登陆系统，请联系客服!');
		}
		setcookie("uniqid",$d['uniqid'], time()+2592000,'/');
		setcookie("nickname",$d['nickname'], time()+2592000,'/');
		setcookie("face",$d['face'], time()+2592000,'/');
        session('uniqid',$d['uniqid']);
        session('nickname',$d['nickname']);
        session('face',$d['face']);
        return returnApi(200,'登陆成功！','',U('Member/index'));
	}

	public function chkPhone(){
		$d = $this->where('phone="%s"',I('post.phone'))->find();
		if($d){
			return true;
		}else{
			return false;
		}
	}



	//插入数据库与之前
    protected function _before_insert(&$data, $options){
    	$data['addtime'] = time();
    }
}