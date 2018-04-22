<?php

// +----------------------------------------------------------------------
// | pay-php-sdk
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/pay-php-sdk
// +----------------------------------------------------------------------

include '../init.php';

// 加载配置参数
$config = require(__DIR__ . '/config.php');

// 支付参数
$payOrder = [
    'out_trade_no' => '4312412343', // 订单号
    'total_amount' => '13', // 订单金额，单位：元
    'subject'      => '订单商品标题', // 订单商品标题
    'auth_code'    => '123456', // 授权码
];

// 实例支付对象
$pay = new \Pay\Pay($config);

try {
    $options = $pay->driver('alipay')->gateway('pos')->apply($payOrder);
    var_dump($options);
} catch (Exception $e) {
    echo "创建订单失败，" . $e->getMessage();
}


