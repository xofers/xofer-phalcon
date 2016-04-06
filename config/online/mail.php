<?php

/**
 *
 * @description :正式环境-邮件配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

return [

    'mail'=>[

        'driver'        =>  'smtp',

        'host'          =>  'smtp.exmail.qq.com',

        'port'          =>  465,

        'encryption'    =>  'ssl',

        'userName'      =>  'dev@duocai.cn',

        'passWord'      =>  'Duocai2015',

        'from'          =>  [

            'email'     =>      'dev@duocai.cn',

            'name'      =>      APP_NAME . ' - 技术研发中心'

        ]
    ]
];