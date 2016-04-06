<?php

/**
 *
 * @description :线上环境-数据库配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

return [
    'db_w'    =>  [

        'adapter'   => 'Mysql',

        'host'      => $_SERVER['DC_MYSQL_MASTER_HOST'],

        'username'  => $_SERVER['DC_MYSQL_MASTER_USER'],

        'password'  => $_SERVER['DC_MYSQL_MASTER_PWD'],

        'dbname'    => $_SERVER['DC_MYSQL_MASTER_DB'],

        'port'      => $_SERVER['DC_MYSQL_MASTER_PORT'],

        'charset'   => 'utf8',

    ],

    'db_r'  =>  [

        'adapter'   => 'Mysql',

        'host'      => $_SERVER['DC_MYSQL_SLAVE_HOST'],

        'username'  => $_SERVER['DC_MYSQL_SLAVE_USER'],

        'password'  => $_SERVER['DC_MYSQL_SLAVE_PWD'],

        'dbname'    => $_SERVER['DC_MYSQL_SLAVE_DB'],

        'port'      => $_SERVER['DC_MYSQL_SLAVE_PORT'],

        'charset'   => 'utf8',

    ]
];