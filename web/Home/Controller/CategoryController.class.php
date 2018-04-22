<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
class CategoryController extends LayoutController {




	public function index(){
		$cate_id = I('get.id');
		if(is_numeric($cate_id) && !empty($cate_id)){
			$goodsModel = D('Goods');
			// 获取商品列表
			$data['goods'] = $goodsModel->getGoodsFromCate($cate_id,'cateIndex');
			// 获取关联推荐产品

			// 获取栏目信息
			$cateModel = D('Category');
			$data['cateInfo'] = $cateModel->getInfo($cate_id);
			$data['showall'] = false;
		}else{
			// 显示全部的业务
			$data['showall'] = true;
		}
		$this->assign('data',$data);
		$this->display();
	} 




}