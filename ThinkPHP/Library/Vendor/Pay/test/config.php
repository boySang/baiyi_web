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

return [
    // 微信支付参数
    'wechat' => [
        'debug'      => true, // 沙箱模式
        'app_id'     => 'wxe335431b79068046', // 应用ID
        'mch_id'     => '1300513101', // 微信支付商户号
        'mch_key'    => 'AGNq9Z6I9xQ7usWT2xPXc76pS9HUvcoq', // 微信支付密钥
        'ssl_cer'    => __DIR__ . '/cert/1300513101_cert.pem', // 微信证书 cert 文件
        'ssl_key'    => __DIR__ . '/cert/1300513101_key.pem', // 微信证书 key 文件
        'notify_url' => 'http://localhost/wxpay-notify.php', // 支付通知URL
        'return_url' => 'http://localhost/wxpay-notify.php', // WEB支付成功后返回地址
    ],
    // 支付宝支付参数
    'alipay' => [
        // 沙箱模式
        'debug'       => true,
        // 应用ID
        'app_id'      => '2016090900468879',
        // 支付宝公钥(1行填写)
        'public_key'  => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB',
        // 支付宝私钥(1行填写)
        'private_key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC3pbN7esinxgjE8uxXAsccgGNKIq+PR1LteNTFOy0fsete43ObQCrzd9DO0zaUeBUzpIOnxrKxez7QoZROZMYrinttFZ/V5rbObEM9E5AR5Tv/Fr4IBywoS8ZtN16Xb+fZmibfU91yq9O2RYSvscncU2qEYmmaTenM0QlUO80ZKqPsM5JkgCNdcYZTUeHclWeyER3dSImNtlSKiSBSSTHthb11fkudjzdiUXua0NKVWyYuAOoDMcpXbD6NJmYqEA/iZ/AxtQt08pv0Mow581GPB0Uop5+qA2hCV85DpagE94a067sKcRui0rtkJzHem9k7xVL+2RoFm1fv3RnUkMwhAgMBAAECggEAAetkddzxrfc+7jgPylUIGb8pyoOUTC4Vqs/BgZI9xYAJksNT2QKRsFvHPfItNt4Ocqy8h4tnIL3GCU43C564B4p6AcjhE85GiN/O0BudPOKlfuQQ9mqExqMMHuYeQfz0cmzPDTSGMwWiv9v4KBH2pyvkCCAzNF6uG+rvawb4/NNVuiI7C8Ku/wYsamtbgjMZVOFFdScYgIw1BgA99RUU/fWBLMnTQkoyowSRb9eSmEUHjt/WQt+/QgKAT2WmuX4RhaGy0qcQLbNaJNKXdJ+PVhQrSiasINNtqYMa8GsQuuKsk3X8TCg9K6/lowivt5ruhyWcP2sx93zY/LGzIHgHcQKBgQDoZlcs9RWxTdGDdtH8kk0J/r+QtMijNzWI0a+t+ZsWOyd3rw+uM/8O4JTNP4Y98TvvxhJXewITbfiuOIbW1mxh8bnO/fcz7+RXZKgPDeoTeNo717tZFZGBEyUdH9M9Inqvht7+hjVDIMCYBDomYebdk3Xqo4mDBjLRdVNGrhGmVQKBgQDKS/MgTMK8Ktfnu1KzwCbn/FfHTOrp1a1t1wWPv9AW0rJPYeaP6lOkgIoO/1odG9qDDhdB6njqM+mKY5Yr3N94PHamHbwJUCmbkqEunCWpGzgcQZ1Q254xk9D7UKq/XUqW2WDqDq80GQeNial+fBc46yelQzokwdA+JdIFKoyinQKBgQCBems9V/rTAtkk1nFdt6EGXZEbLS3PiXXhGXo4gqV+OEzf6H/i/YMwJb2hsK+5GQrcps0XQihA7PctEb9GOMa/tu5fva0ZmaDtc94SLR1p5d4okyQFGPgtIp594HpPSEN0Qb9BrUJFeRz0VP6U3dzDPGHo7V4yyqRLgIN6EIcy1QKBgAqdh6mHPaTAHspDMyjJiYEc5cJIj/8rPkmIQft0FkhMUB0IRyAALNlyAUyeK61hW8sKvz+vPR8VEEk5xpSQp41YpuU6pDZc5YILZLfca8F+8yfQbZ/jll6Foi694efezl4yE/rUQG9cbOAJfEJt4o4TEOaEK5XoMbRBKc8pl22lAoGARTq0qOr9SStihRAy9a+8wi2WEwL4QHcmOjH7iAuJxy5b5TRDSjlk6h+0dnTItiFlTXdfpO8KhWA8EoSJVBZ1kcACQDFgMIA+VM+yXydtzMotOn21W4stfZ4I6dHFiujMsnKpNYVpQh3oCrJf4SeXiQDdiSCodqb1HlKkEc6naHQ=',
        // 支付通知URL
        'notify_url'  => 'http://localhost/wxpay-notify.php',
    ]
];