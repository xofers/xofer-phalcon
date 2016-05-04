<?php

/**
 *
 * @description :开发环境-redis配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */
return [

    'redis_r' =>[

        'host' => '122.144.133.170' ,

        'port' => 6379,

//        'auth' => '',

        'persistent' => false,

        'uniqueId'   => '6oS3upfdOrSAcYLG',

        'lifetime'   => 3600 * 24,

        'prefix'     => '_DCWX_SESSION_',
    ],

    'redis_w'=>[

        'host' => '122.144.133.170' ,

        'port' => 6379,

//        'auth' => '',

        'persistent' => false,

        'uniqueId'   => '6oS3upfdOrSAcYLG',

        'lifetime'   => 3600 * 24,

        'prefix'     => '_DCWX_SESSION_',
    ]
];