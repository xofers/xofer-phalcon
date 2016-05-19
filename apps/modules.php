<?php
/**
 *
 * @description :模块注册
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

return [
    'welcome' => [
        'className' => 'Dc\Welcome\Module',
        'path' => __DIR__ . '/../apps/welcome/Module.php'
    ],

    'wechat' => [
        'className' => 'Dc\Wechat\Module',
        'path' => __DIR__ . '/../apps/wechat/Module.php'
    ],

    'activity' => [
        'className' => 'Dc\Activity\Module',
        'path' => __DIR__ . '/../apps/activity/Module.php'
    ]
];