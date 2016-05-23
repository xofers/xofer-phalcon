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

        'level' =>  \Monolog\Logger::DEBUG,

        'file'  =>  !isset($_SERVER['DC_WX_DIR_LOG'])?:$_SERVER['DC_WX_DIR_LOG'].'/'.MODULE_NAME.'/error/'.date('Ym').'/'.date('Ymd').'-TYPE'.'.log',

    ],

];