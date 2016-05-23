<?php
/**
 *
 * @description :服务列表
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:45
 *
 */

return [
    'config' => [
        'className' => Dc\Modules\Services\Config::class,
    ],

    'router' => [
        'className' => Dc\Modules\Services\Router::class,
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
        'className' => Dc\Modules\Services\Mysql::class,
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
        'className' => Dc\Modules\Services\Mysql::class,
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
        'className' => Dc\Modules\Services\Logger::class,
        'arguments' => [
            [
                'type' => 'service',
                'name' => 'config',
            ]
        ]
    ],

    'session' => [
        'className' => Dc\Modules\Services\Session::class,
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
        'className' => Dc\Modules\Services\Cache::class,
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
    ]
];