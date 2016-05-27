<?php
/**
 *
 * @description :模块服务列表
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:45
 *
 */
namespace App\Welcome\Services;

use App\Welcome\Events;

return [

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
    ]

];