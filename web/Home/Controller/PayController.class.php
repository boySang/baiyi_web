<?php
namespace Home\Controller;
use Home\Controller\LayoutController;
import("Vendor.Pay.init");

class PayController extends LayoutController {



	public function alipay(){
		// 加载配置参数
		$config = array(
		    // 微信支付参数
		    // 'wechat' => array(
		    //     'debug'      => true, // 沙箱模式
		    //     'app_id'     => 'wxe335431b79068046', // 应用ID
		    //     'mch_id'     => '1300513101', // 微信支付商户号
		    //     'mch_key'    => 'AGNq9Z6I9xQ7usWT2xPXc76pS9HUvcoq', // 微信支付密钥
		    //     'ssl_cer'    => __DIR__ . '/cert/1300513101_cert.pem', // 微信证书 cert 文件
		    //     'ssl_key'    => __DIR__ . '/cert/1300513101_key.pem', // 微信证书 key 文件
		    //     'notify_url' => 'http://localhost/wxpay-notify.php', // 支付通知URL
		    //     'return_url' => 'http://localhost/wxpay-notify.php', // WEB支付成功后返回地址
		    // ),
		    // 支付宝支付参数
		    'alipay' => array(
		        // 沙箱模式
		        'debug'       => false,
		        // 应用ID
		        'app_id'      => '2018041302550102',
		        // 支付宝公钥(1行填写)
		        'public_key'  => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzL7VI7w2ucjkVVQ1wD8YKWwyCEJEK3utFMDMW6z1l8/RNVIX3P8pKtXHPOR6y8LTeVqiZ4smTukqIdlQyafyaL8zYS69hUsQbVnQGNJZ5COOY3CX8owW6CIZ4Bfv0YU3kgSzy/a9jZY6sUEdLFX7NnOKs1v4vXqC7NHhT10fIgFmSXYwUyFkzNzzML9ptTH2sJW/iKlGNd3RverECKAuo4ejrFktu3+LBp+60lcRGW+1nU1oCx3Io1N6nC+XTv5ej08t6MB7X6rmh46ghNqUqNV1UrgJx1alQw4H3v1L7mtAiaaGLfW7lrXd3Iu19aSM/1/DrLpctH5glhX7Q9PmgwIDAQAB',
		        // 支付宝私钥(1行填写)
		        'private_key' => 'MIIEpAIBAAKCAQEAzL7VI7w2ucjkVVQ1wD8YKWwyCEJEK3utFMDMW6z1l8/RNVIX3P8pKtXHPOR6y8LTeVqiZ4smTukqIdlQyafyaL8zYS69hUsQbVnQGNJZ5COOY3CX8owW6CIZ4Bfv0YU3kgSzy/a9jZY6sUEdLFX7NnOKs1v4vXqC7NHhT10fIgFmSXYwUyFkzNzzML9ptTH2sJW/iKlGNd3RverECKAuo4ejrFktu3+LBp+60lcRGW+1nU1oCx3Io1N6nC+XTv5ej08t6MB7X6rmh46ghNqUqNV1UrgJx1alQw4H3v1L7mtAiaaGLfW7lrXd3Iu19aSM/1/DrLpctH5glhX7Q9PmgwIDAQABAoIBAQClfnavnNmrT/toEVolG5q/GKpUTKPndd9QEAre6y3UWPFkpQeO5Vx0ODoEOTYcb00aIS12fl4nmIYquAp6BVuGWU4BdpNQI32Ste7jsVthcXANZpwbPCrj1XSO0ypQc9qYF17xNW6//DdSwSwAgzs8JyZslaG4Hkenfnoc+UtJ4t2W38/hYkIZyRj6n/EcB7Ny4ASCNE5yTgorusvtn3kTjoIDR8h4O799/OaYVUwI5v/EvSxAzBuieY4Di8NLXn2CSR4pX1MziqexQ6dxJ+khhtveXSbakmKPohof3Tf1BoEardh8iuuknAYjb/4Lvwr1vXNiSbMm5Ie7BzF20ayhAoGBAP4iS3dac/877S7IJGFCvECR+vUMv55szIeGqQ3L99Udjzvz8t+raZcsS8zfP8Q8BvoCjxnMRBqOgT1viK870jF/CbNFoSujtAhhIkRp+bVPgeM5hv5phDPiBNasBejLzZJ7LJYeBQjOZ1/p+C612RC09RK8B4EgXsnkGDZ2WGBTAoGBAM4/s0eqA/7ZE9MjzvEYi1+1f0CuD+Dnhn+rwLI9Aip8q2OoNhOHmdn19YQZUVuh60Tmve7+ff4sxCARHxcrHpAjiUE7i+1mbVbNbGtQc5NqjND9TCPYX0BNqxPWCGdkQDJNF9z2NZAP52huLO8DJkXqLWhhFh0Is/Uqg1w0aFsRAoGAbf7OBzThbCG2AT+jb22BKbmFk7cW4S1aQXapiU01UcrfiiWGhAUfSM1laaFfakJJCsE8yv+8onn3um2iDaaozb+cpTmIDulmLRJN0KrF6BInt//YTBnDnOlBCuGeFSrRKYuiur73kt4zpDISt7UB5NdOE/PKk7s9C8lsKXaDvf0CgYB16GC7hWyHUt5MhFoX5qo26vF2rouRTYrMjgm5W7tTQrZQYKeZfpnryvqyrC6gre5sE2VdrculdT4h/ufBPPtZ95bN3hbefwHe780dhH6uNemOyF+w1k+N2VkGHAPt55fzqbMMtQxl8VGfl+zELw7ARWH0HByiOIl4jPdPzP4joQKBgQC1WkgCD8TDJ/NmmhhNmyIETbg9PAfzINNXV/GSB3gRywwE+w/xqiYzvzS44zLV3e6H09GF4yRAZIfsLu6tp6Osw2Cq/5GmL99xwYxlsRObtTJEjqJJyTaPX67NCf2b+zggdLHRWzNwqJQYju1lTf0nRwIFXSWFxmY4QoOPgOYERg==',
		        //异步通知地址
				'notify_url' => "http://apply.foridom.com/Pay/notify",
				//同步跳转
				'return_url' => "http://apply.foridom.com/Pay/result",
		        //编码格式
				'charset' => "UTF-8",
				//签名方式
				'sign_type'=>"RSA2",
		    )
		);

		// 获取订单信息
		$order_m = D('OrderDetail');
		$order_d = $order_m->getOneFromUniquenum(I('post.uniquenum','','htmlspecialchars'));
		if(!$order_d){
			$this->error('订单有误');
		}

		if($order_d['order_type'] == 1){
			$order_d['goods_name'] = '【'.$order_d['goods_name'].'】商标自助申请';
		}

		// 支付参数
		$payOrder = array(
		    'out_trade_no' => $order_d['uniquenum'], // 商户订单号
		    'total_amount' => $order_d['total_price'], // 支付金额
		    'subject'      => $order_d['goods_name'], // 支付订单描述
		);

		// 实例支付对象
		$pay = new \Pay\Pay($config);

		try {
		    $options = $pay->driver('alipay')->gateway('web')->apply($payOrder);
		    echo $options;
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
	}

	public function result(){
		$total_amount = I('get.total_amount');
		$paytime = I('get.timestamp');
		$app_id = I('get.app_id');
		$uniquenum = I('get.out_trade_no');
		if($total_amount && $paytime && $app_id && $uniquenum){
			$orderDetailModel = D('OrderDetail');
			// 暂时先不判断订单，直接修改

			$r = $orderDetailModel->where('uniquenum="%s"',$uniquenum)->setField(array(
				'paytime'		=>		strtotime($paytime),
				'state'			=>		101,
				'order_type'	=>		0,
			));
			// 修改为付费会员
			$memberModel = D('Member');
			$memberModel->where('uniqid="%s"',session('uniqid'))->setField('vip_state',1);
			if($r !== false){
				header('Location:'.U('ConnectIndustry/uploadinfosucc'));
			}else{
				$this->error('修改订单失败！');
			}
		}else{
			header('Location:'.U('Index/index'));
		}
	}
}