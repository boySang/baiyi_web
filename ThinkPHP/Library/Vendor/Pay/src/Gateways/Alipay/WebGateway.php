<?php

// +----------------------------------------------------------------------
// | pay-php-sdk
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/pay-php-sdk
//

namespace Pay\Gateways\Alipay;

/**
 * 支付宝网站支付网关
 * Class WebGateway
 * @package Pay\Gateways\Alipay
 */
class WebGateway extends Alipay
{

    /**
     * 当前接口方法
     * @return string
     */
    protected function getMethod()
    {
        return 'alipay.trade.page.pay';
    }

    /**
     * 当前接口产品码
     * @return string
     */
    protected function getProductCode()
    {
        return 'FAST_INSTANT_TRADE_PAY';
    }

    /**
     * 应用并返回参数
     * @param array $options
     * @return string
     */
    public function apply(array $options = array())
    {
        parent::apply($options);
        return $this->buildPayHtml();
    }
}
