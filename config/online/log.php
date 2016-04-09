<?php

/**
 *
 * @description :开发环境-日志配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

return  [

    'log'    =>  [

        'level' =>  \Monolog\Logger::ERROR,

        'file'  =>  APP_PATH.'/.storage/wechat/'.date('Ym').'/'.date('Ymd').'.log',

    ],

];