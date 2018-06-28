<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {


	public function show(){
		$m = D('Goods');
    	$data = $m->getAll();
    	$this->assign(array(
    		'data'	=>		$data,
		));
		$this->display();
	}

	public function add(){

		$cateModel = D('Category');
		$cate = $cateModel->getAll();
		// 获取属性
		$optAttrModel = D('optAttr');
		$optAttrData = $optAttrModel->goodsGetAll();
		$this->assign(array(
			'cate'			=>		$cate,
			'optAttrData'	=>		$optAttrData,
		));
		$this->display();
	}

	public function update($goods_id){
		$m = D('Goods');
		if(IS_POST){
			$m->save_new($goods_id) ? header('Location:'.PREV_URL): $this->error('修改失败');
		}

		$cateModel = D('Category');
		$cate = $cateModel->getAll();
		// 获取属性
		$optAttrModel = D('optAttr');
		$optAttrData = $optAttrModel->goodsGetAll();

		$goodsInfo = $m->getGoodsOne($goods_id);
		// var_dump($goodsInfo);

		$this->assign(array(
			'cate'			=>		$cate,
			'optAttrData'	=>		$optAttrData,
			'goods'			=>		$goodsInfo,
		));
		$this->display();
	}

	public function ajaxAdd(){
		header('Content-type:text/json');
		$m = D('Goods');
		echo $m->ajaxAdd();
	}

	public function del($id){
		$m = D('Goods');
		$m->delete($id) != false? header('Location:'.PREV_URL): $this->error('删除失败');
	}

	public function uploadimg(){
		header('Content-type:text/json');
		$d =  array(
			'errno'		=>		0
		);
		echo json_decode($d);
		return $d[123]['123'];
		if(isset($_FILES['license'])){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     31457280 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
			$upload->savePath  =      'Company/'; // 设置附件上传（子）目录
			// 上传文件
			$info   =   $upload->upload();
			if($info) {// 上传成功 获取上传文件信息
				foreach($info as $file){
					if($file['key'] == 'license'){
						$license = $file['savepath'].$file['savename'];
			            $sm_license = $info['license']['savepath'].'sm_'.$info['license']['savename'];
			            // 打开图片
			            $image = new \Think\Image();
			            $image->open('./Uploads/'.$license);
			            // 生成缩略图
			            $image->thumb(140, 140,\Think\Image::IMAGE_THUMB_FILLED)->save('./Uploads/'.$sm_license);
			            // 图片路径存到数据库中
			            $data['license'] = $license;
			            $data['sm_license'] = $sm_license;
					}
				}
			}
        }
	}

	public function todel(){
		header('Content-type:text/json');
		$m = D('Goods');
		echo $m->todel();
	}
}