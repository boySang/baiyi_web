<?php

// 返回json数组数据
function returnApi($state,$msg,$data = '',$url = ''){

	$result['state'] = $state;

	$result['msg'] = $msg;

	if($data != null){
		$result['data'] = $data;
	}

	if($url != ''){
		$result['url'] = $url;
	}
	
	return json_encode($result);
}

// 给一张图片添加链接
function getImgOne($data,$no_pic = 'goods_default_pic.jpg'){
	if($data){
        if(file_exists('./Uploads/'.$data)){
            $data = UPLOADS_PATH.$data;
        }else{
            $data = DIST.'img/'.$no_pic;
        }
    }else{
        $data = DIST.'img/'.$no_pic;
    }
    return $data;
}

function getImgList($data,$field,$no_pic){
	foreach($data as $k=>$v){
        if($v[$field]){
            if(file_exists('./Uploads/'.$v[$field])){
                $data[$k][$field] = UPLOADS_PATH.$v[$field];
            }else{
                $data[$k][$field] = DIST.'img/'.$no_pic;
            }
        }else{
            $data[$k][$field] = DIST.'img/'.$no_pic;
        }
    }
    return $data;
}