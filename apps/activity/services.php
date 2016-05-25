<?php
/**
 *
 * @description :模块服务列表
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:45
 *
 */
namespace App\Activity\Services;

use Dc\Modules\Services\Repository;

return [

    'view' => [
        'className' => View::class,
    ],

    'repository' => [
        'className' => Repository::class,
        'arguments' => [
            [
                'type' => 'parameter',
                'value' => 'App\\Activity\\Repositories',
            ]
        ]
    ]
];