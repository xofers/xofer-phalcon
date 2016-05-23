<?php
/**
 *
 * @description :服务列表
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:45
 *
 */

namespace Dc\Modules\Services;


return [
    'config' => [
        'className' => Config::class,
    ],

    'router' => [
        'className' => Router::class,
        'arguments' => [
            [
                'type' => 'parameter',
                'value' => true
            ],
            [
                'type' => 'parameter',
                'value' => array_keys(loadFile(__DIR__ . '/modules.php')->toArray())
            ]
        ]
    ],

    'dbWrite' => [
        'className' => Mysql::class,
        'arguments' => [
            [
                'type' => 'parameter',
                'value' => ['db_w'],
            ],
            [
                'type' => 'service',
                'name' => 'config',
            ]
        ]
    ],

    'dbRead' => [
        'className' => Mysql::class,
        'arguments' => [
            [
                'type' => 'parameter',
                'value' => ['db_r']
            ],
            [
                'type' => 'service',
                'name' => 'config',
            ]
        ]
    ],

    'logger' => [
        'className' => Logger::class,
        'arguments' => [
            [
                'type' => 'service',
                'name' => 'config',
            ]
        ]
    ],

    'session' => [
        'className' => Session::class,
        'arguments' => [
            [
                'type' => 'service',
                'name' => 'config',
            ],
            [
                'type' => 'parameter',
                'value' => [

                    'replication' => true,

                    'prefix' => '_DCWX_SESSIONS_'
                ]
            ]
        ]
    ],

    'cache' => [
        'className' => Session::class,
        'arguments' => [
            [
                'type' => 'service',
                'name' => 'config',
            ],
            [
                'type' => 'parameter',
                'value' => [

                    'replication' => true,

                    'prefix' => '_DCWX_CACHE_'
                ]
            ]
        ]
    ],

    'wechat' => [
        'className' => Wechat::class,
        'arguments' => [
            [
                'type' => 'service',
                'name' => 'config',
            ],
            [
                'type' => 'service',
                'name' => 'cache',
            ]
        ]
    ]
];