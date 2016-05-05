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
    [
        'schame'    => 'tcp',

        'host'      => '122.144.133.170' ,

        'port'      => 6379,

        'alias'     => 'master',
    ],
    [
        'schame'    => 'tcp',

        'host'      => '122.144.133.170' ,

        'port'      => 6379,

        'alias'     => 'slave-01',
    ]
];