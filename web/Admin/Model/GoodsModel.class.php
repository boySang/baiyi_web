<?php 
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{


	public function getAll(){

		$where = ' a.cate_id=b.id AND a.is_del=0 ';

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
					a.goods_id DESC 
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
					$data[$k]['attrprice'] = $goodsAttrData;
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

	public function getList(){
		$d = $this->field('goods_id,goods_name')->select();
		return $d;
	}

	public function getName($goods_id){
		$d = $this->field('goods_name')->find($goods_id);
		return $d['goods_name'];
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
		//$attr = I('post.attr');
		$attrval = I('post.attrval');
		$attr_price = I('post.attr_price');
		// return returnApi(200,'添加商品及属性成功',$attr_price);
		$result = $this->add($data);
		if($result){
			if($attrval){
				foreach($attrval as $k=>$v){
					$_attr[$k]['goods_id'] = $result;
					// $_attr[$k]['attr'] = $v;
					$_attr[$k]['attrval'] = implode(',', $v);
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

	public function save_new($goods_id){
		$goods_name = I('post.goods_name');
		$goods_content = I('post.goods_content','','htmlspecialchars');
		$goods_default_price = I('post.goods_default_price');
		$r = $this->where('goods_id=%d',$goods_id)->setField(array(
			'goods_name'				=>		$goods_name,
			'goods_content'				=>		$goods_content,
			'goods_default_price'		=>		$goods_default_price,
		));
		if($r !== false){
			return true;
		}else{
			return false;
		}
	}

	public function getGoodsOne($goods_id){
		$d = $this->field('goods_id,goods_name,goods_content,goods_default_price')->where('goods_Id=%d',$goods_id)->find();
		$d['goods_content'] = htmlspecialchars_decode($d['goods_content']);
		return $d;
	}

	public function todel(){
		$goodsId = I('get.id');
		if($goodsId){
			$result = $this->where('goods_id=%d',$goodsId)->setField('is_del',1);
			if($result){
				return returnApi(200,'success');
			}else{
				return returnApi(202,'修改参数失败！');
			}
		}else{
			return returnApi(201,'id有误');
		}
	}

	protected function _before_insert(&$data, $options){
		$data['addtime'] = time();
		$data['updatetime'] = time();
	}

	protected function _before_delete(&$data, $options){
		// 删除商品之前，检测商品属性，有的话就删除
		$goodsAttrModel = D('GoodsAttr');
		$goodsAttrData = $goodsAttrModel->getAll($data['where']['goods_id']);
		if($goodsAttrData){
			// 删除所有的属性
			$goodsAttrModel->delFromGoodsId($data['where']['goods_id']);
		}
	}
}