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
setcookie("uniqid",$data['uniqid'], time()+2592000,'/');
                setcookie("phone",$data['phone'], time()+2592000,'/');
        session('uniqid',$data['uniqid']);
        session('phone',$data['phone']);

			return returnApi(200,'恭喜！注册成功');
		}else{
			return returnApi(202,'注册失败，请联系客服');
		}
	}

	public function ajaxLogin(){
		$d = $this->field('uniqid,face,state,nickname,phone')->where('phone="%s" AND paswd="%s"',I('post.phone'),md5(I('post.paswd')))->find();
		if(!$d['uniqid']){
			return returnApi(202,'账号或密码不正确!');
		}
		if($d['state'] == 0){
			return returnApi(202,'该用户禁止登陆系统，请联系客服!');
		}
		setcookie("uniqid",$d['uniqid'], time()+2592000,'/');
		setcookie("phone",$d['phone'], time()+2592000,'/');
		setcookie("nickname",$d['nickname'], time()+2592000,'/');
        session('uniqid',$d['uniqid']);
        session('phone',$d['phone']);
        session('nickname',$d['nickname']);
        return returnApi(200,'登陆成功！','',U('Index/index'));
	}

	public function ajaxManageLogin(){
		$d = $this->field('uniqid,face,state,nickname,phone')->where('phone="%s" AND paswd="%s"',I('post.phone'),md5(I('post.paswd')))->find();
		if(!$d['uniqid']){
			return returnApi(202,'账号或密码不正确!');
		}
		if($d['state'] == 0){
			return returnApi(202,'该用户禁止登陆系统，请联系客服!');
		}
		// if(I('post.remember')){
			setcookie("uniqid",$d['uniqid'], time()+2592000,'/');
			setcookie("phone",$d['phone'], time()+2592000,'/');
			setcookie("nickname",$d['nickname'], time()+2592000,'/');
		// }else{
		// 	setcookie("uniqid",$d['uniqid']);
		// 	setcookie("phone",$d['phone']);
		// }
        session('uniqid',$d['uniqid']);
        session('phone',$d['phone']);
        session('nickname',$d['nickname']);
        return returnApi(200,'登陆成功！','',U('OnlineManage/ing'));
	}

	// 是否付费会员
	public function isVip(){
		$d = $this->field('vip_state')->where('uniqid="%s"',session('uniqid'))->find();
		if($d['vip_state'] == 1){
			return true;
		}else{
			return false;
		}
	}

	public function getNickname(){
		if($this->truelogin() != true){
			return returnApi(201,'请先登录','',U('Member/login'));
		}
		$d = $this->field('nickname')->where('uniqid="%s"',session('uniqid'))->find();
		if($d['nickname']){
			return returnApi(202,'has');
		}else{
			return returnApi(200,'donthas');
		}
	}

	public function chgnickname(){
		if($this->truelogin() != true){
			return returnApi(201,'请先登录','',U('Member/login'));
		}
		$nickname = I('post.nickname');
		$r = $this->where('uniqid="%s"',session('uniqid'))->setField('nickname',$nickname);
		if($r !== false){
			setcookie("nickname",$nickname, time()+2592000,'/');
        	session('nickname',$nickname);
			return returnApi(200,'修改成功！');
		}else{
			return returnApi(201,'修改失败！');
		}
	}


    // 仅cookie存在
    public function onlylogin(){
    	if(cookie('uniqid') && cookie('phone')){
    		return true;
    	}else{
    		return false;
    	}
    }

    // cookie存在,session存在
    public function truelogin(){
    	if(cookie('uniqid') && cookie('phone') && session('uniqid') && session('phone')){
    		if((cookie('uniqid') === session('uniqid')) && (cookie('phone') === session('phone'))){
    			return true;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }

	public function chkPhone(){
		$d = $this->where('phone="%s"',I('post.phone'))->find();
		if($d){
			return true;
		}else{
			return false;
		}
	}

	public function logout(){
		session('uniqid',null);
    	session('phone',null);
    	cookie('uniqid',null);
    	session('nickname',null);
    	cookie('nickname',null);
    	cookie('phone',null);
    	return true;
	}



	//插入数据库与之前
    protected function _before_insert(&$data, $options){
    	$data['addtime'] = time();
    }
}
