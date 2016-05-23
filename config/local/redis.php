<?php

/**
 * @description :本地环境-redis配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

return [

    'redis' => [

        'master' => [

            'schame' => 'tcp',

            'host' => '127.0.0.1',

            'port' => 6379,

            'alias' => 'master',

        ],

        'slave-01' => [

            'schame' => 'tcp',

            'host' => '127.0.0.1',

            'port' => 6379,

            'alias' => 'slave-01',

        ]
    ]
];