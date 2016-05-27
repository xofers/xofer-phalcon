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

use Dc\Modules\Events;

return [
    'config' => [
        'className' => Config::class,
    ],

    'router' => [
        'className' => Router::class,
        'properties' => [
            [
                'name' => '_event',
                'value' => [
                    'type' => 'instance',
                    'className' => Events\Router::class
                ]
            ]
        ]
    ],

    'dispatcher' => [
        'className' => Dispatcher::class,
        'properties' => [
            [
                'name' => '_event',
                'value' => [
                    'type' => 'instance',
                    'className' => Events\Dispatcher::class
                ]
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
        ],
        'properties' => [
            [
                'name' => '_event',
                'value' => [
                    'type' => 'instance',
                    'className' => Events\Mysql::class
                ]
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
        ],
        'properties' => [
            [
                'name' => '_event',
                'value' => [
                    'type' => 'instance',
                    'className' => Events\Mysql::class
                ]
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

    'view' => [
        'className' => View::class,
        'properties' => [
            [
                'name' => '_event',
                'value' => [
                    'type' => 'instance',
                    'className' => Events\View::class
                ]
            ]
        ]
    ],

    'debug' => [
        'className' => Debug::class,
        'arguments' => [
            [
                'type' => 'service',
                'name' => 'config',
            ],
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