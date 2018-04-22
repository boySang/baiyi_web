<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Org\Util;
/**
 */

class Baitu {

	/**
	 *	按关键字，根据注册号码、商标名称或申请人查询商标列表
	 *	@url 
	 *
	 *	@return json
	 */ 
	public function getTrademarkInquiries($cxkey,$cxcls,$cxtype,$pagesize,$pageno,$ispost = false){

		$url = 'http://api.cha-tm.net/chatmbs/tmapi/apikh/default.do?method=query';
		$params = array(
			'apikey'		=>		APIKEY,	
			'apipass'		=>		APIKEYID,	
			'cxkey'			=>		$cxkey,			//	查询关键字
			'cxcls'			=>		$cxcls,			//	查询类别，全类：空；单类：01；多类：01,03,05
			'cxtype'		=>		$cxtype,		//	查询类型，1-注册号；2-商标名称；3-申请人；
			'pagesize'		=>		$pagesize,		//	页面大小，范围1-30
			'pageno'		=>		$pageno			//	当前页码
		);
		// 拼接url
		$paramstring = http_build_query($params);
		$content = $this->baitucurl($url,$paramstring,$ispost);
		// $result = json_decode($content);
		if($content){
			echo $content;
		}else{
			echo '请求失败';
		}
	}

	/**
	 *	根据注册号码查询商标详细信息
	 *	@url 
	 *
	 *	@return json
	 */ 
	public function getTrademarkInfo($cxkey,$cxcls, $ispost = false){

		$url = 'http://api.cha-tm.net/chatmbs/tmapi/apikh/default.do?method=queryInfo';
		$params = array(
			'apikey'		=>		APIKEY,	
			'apipass'		=>		APIKEYID,
			'cxkey'			=>		$cxkey,		//	查询关键字
			'cxcls'			=>		$cxcls		//	查询类别，全类：空；单类：01；多类：01,03,05
		);
		// 拼接url
		$paramstring = http_build_query($params);
		$content = $this->baitucurl($url,$paramstring,$ispost);
		// $result = json_decode($content);
		if($content){
			echo $content;
		}else{
			echo '请求失败';
		}
	}

	/**
	 *	根据注册号码查询商标历史流程信息
	 *	@url 
	 *
	 *	@return json
	 */ 
	public function getTrademarkProcess($cxkey,$cxcls, $ispost = false){
		$url = 'http://api.cha-tm.net/chatmbs/tmapi/apikh/default.do?method=queryFlow';
		$params = array(
			'apikey'		=>		APIKEY,	
			'apipass'		=>		APIKEYID,
			'cxkey'			=>		$cxkey,		//	查询关键字
			'cxcls'			=>		$cxcls,		//	查询类别，全类：空；单类：01；多类：01,03,05
		);
		// 拼接url
		$paramstring = http_build_query($params);
		$content = $this->baitucurl($url,$paramstring,$ispost);
		// $result = json_decode($content,true);
		if($content){
			echo $content;
		}else{
			echo '请求失败';
		}
	}



	/**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	private function baitucurl($url,$params=false,$ispost=0){
	    $httpInfo = array();
	    $ch = curl_init();
	 
	    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
	    curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
	    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
	    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if( $ispost )
	    {
	        curl_setopt( $ch , CURLOPT_POST , true );
	        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
	        curl_setopt( $ch , CURLOPT_URL , $url );
	    }
	    else
	    {
	        if($params){
	            curl_setopt( $ch , CURLOPT_URL , $url.'&'.$params );
	        }else{
	            curl_setopt( $ch , CURLOPT_URL , $url);
	        }
	    }
	    $response = curl_exec( $ch );
	    if ($response === FALSE) {
	        //echo "cURL Error: " . curl_error($ch);
	        return false;
	    }
	    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
	    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
	    curl_close( $ch );
	    return $response;
	}	




}