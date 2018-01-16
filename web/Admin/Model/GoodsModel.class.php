<?php 
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{


	public function getAll(){

		$where = ' a.cate_id=b.id ';

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

		//获取总条数
		// $total = $this->where($where)->count();
		$total = $this->query("
			SELECT COUNT(temp.goods_id) as total
			FROM (
				SELECT 
						a.goods_id
				FROM 
						by_goods a,by_category b 
				WHERE 
						".$where." 
			) temp
		");

		//生成翻页对象
		$page = new \Think\Page($total[0]['total'],$pagesize);

		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');

		//生成翻页字符串
		$show = $page->show();
		//生成翻页的数据
		// $data = $this->field('goods_id,goods_name,')->order('readnum DESC')->limit($page->firstRow,$page->listRows)->select();
		$data = $this->query("
			SELECT 
					a.goods_id,a.goods_name,a.goods_default_price,b.title cate_title,a.goods_thumb,a.goods_default_price,a.addtime,a.readnum
			FROM 
					by_goods a,by_category b 
			WHERE 
					".$where." 
			ORDER BY 
					a.readnum DESC 
			LIMIT 
					".$page->firstRow.",".$page->listRows
		);
		if($data){
			foreach ($data as $k => $v) {
				$data[$k]['goods_thumb'] = getImgOne($v['goods_thumb']);
				$data[$k]['addtime'] = date('Y-m-d H:i',$v['addtime']);
				$data[$k]['review_url'] = U('../Goods/detail/id/'.$v['goods_id']);
				$goodsAttrModel = D('GoodsAttr');
				$goodsAttrData = $goodsAttrModel->getAll($v['goods_id']);
				if($goodsAttrData){
					// var_dump($goodsAttrData);
					// $attrStr = '';
					// foreach($goodsAttrData as $k1 => $v1){
					// 	$attrStr += . 
					// }
				}else{
					$data[$k]['attrprice'] = '默认价格：'.($v['goods_default_price'] / 100).' 元';
				}
			}
			//返回翻页字符串和数据
			return array(
				'data'=>$data,
				'page'=>$show,
				'total'=>$total[0]['total'],
				'num'=>$num,
			);
		}
			
	}

	public function ajaxAdd(){
		$data['goods_name'] = I('post.goods_name','','htmlspecialchars');
		$data['cate_id'] = I('post.cate_id','','htmlspecialchars');
		$data['keywords'] = I('post.keywords','','htmlspecialchars');
		$data['goods_info'] = I('post.goods_info','','htmlspecialchars');
		$data['goods_tips'] = I('post.goods_tips','','htmlspecialchars');
		$data['goods_content'] = I('post.goods_content','','htmlspecialchars');
		$data['goods_thumb'] = I('post.goods_thumb','','htmlspecialchars');
		$data['goods_default_price'] = I('post.goods_default_price','','htmlspecialchars')*100;
		$attr = I('post.attr');
		$attrval = I('post.attrval');
		$attr_price = I('post.attr_price');
		$result = $this->add($data);
		if($result){
			if(count($attr) > 0){
				foreach($attr as $k=>$v){
					$_attr[$k]['goods_id'] = $result;
					$_attr[$k]['attr'] = $v;
					$_attr[$k]['attrval'] = $attrval[$k];
					$_attr[$k]['attr_price'] = $attr_price[$k]*100;
				}
				$goodsAttrModel = D('GoodsAttr');
				$_attrResult = $goodsAttrModel->addAll($_attr);
				if($_attrResult){
					return returnApi(200,'添加商品及属性成功');
				}else{
					return returnApi(202,'添加商品属性失败');
				}
			}else{
				return returnApi(200,'添加商品成功');
			}
		}else{
			return returnApi(201,'添加商品失败');
		}
	}

	protected function _before_insert(&$data, $options){
		$data['addtime'] = time();
		$data['updatetime'] = time();
	}
}