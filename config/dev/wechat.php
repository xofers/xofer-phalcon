<?php

/**
 *
 * @description :开发环境-微信公众号配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

return  [

    'wechat'    =>  [

        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug'  => false,

        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id'  => 'wxb66b650240f8dff2',                          // AppID
        'secret'  => 'd4624c36b6795d1d99dcf0547af5443d',            // AppSecret
        'token'   => '7mjioFsM1q',                                  // Token
        'aes_key' => 'I5RhzYaHLQDgZpzNaQTR1Wu9vSP4eGjlbFZp9hCdqYC', // EncodingAESKey

        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => 'debug',
            'file'  => !isset($_SERVER['DC_WX_DIR_LOG'])?:$_SERVER['DC_WX_DIR_LOG'].'/wechat/'.date('Ym').'/'.date('Ymd').'.log',
        ],

        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/wechat/server/authorize',
        ],

        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id'        => '1226449602',
            'key'                => 'EgTHxJhoJHPLrpkWrttZPWTnhaulIDze',
            'cert_path'          => APP_PATH.'/library/pem/cert.pem',
            'key_path'           => APP_PATH.'/library/pem/key.pem',
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...
        ],

    ]
];