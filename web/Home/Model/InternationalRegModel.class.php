<?php 
namespace Home\Model;
use Think\Model;

class InternationalRegModel extends Model{


	// 根据条件获取所有国家信息
	public function ajaxGetCountry(){

		$from = I('get.from','','htmlspecialchars');

		if($from == '' || $from == null){
			return returnApi(201,'参数不能为空');
		}elseif($from == 'madeli'){

			// 获取所有马德里国家
			$countryModel = D('Country');
			$madeliData = $countryModel->getCountrys('is_madeli=1');

			// 获取五大洲
			$continent = array();
			// 重新排序国家，按洲区分
			$country = array();

			foreach($madeliData as $k=>$v){
				$az[$k] = $v['first_letter'];
				$continent[$k] = $v['continent'];
			}


			// 去重五大洲
			$continent = array_flip($continent);
			$continent = array_keys($continent);
			$data['continent'] = $continent;

			// 重新排序国家
			foreach($continent as $k=>$v){
				foreach($madeliData as $k1=>$v1){
					if($v == $v1['continent']){
						$country[$k]['countrys'][] = $v1;
					}
				}
			}
			foreach($country as $k=>$v){

				// 获取a-z的排序
				$az = array();
				foreach($v['countrys'] as $k1=>$v1){
					$az[$k1] = $v1['first_letter'];
				}
				// 重新排序a~z
				$az = array_flip($az);
				ksort($az,SORT_NATURAL);
				$az = array_keys($az);
				$country[$k]['az'] = $az;
				
			}
			$data['country'] = $country;

			return returnApi(200,'success',$data);

		}elseif($from == 'dandu'){

		}elseif($from == 'oumeng'){
			
		}else{
			return returnApi(202,'参数错误');
		}
	}












}