<?php

/**
 *
 * @description :开发环境-发送邮件配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

return [

    'mail'=>[

        'host'          =>  'smtp.exmail.qq.com',

        'userName'      =>  'dev@duocai.cn',

        'passWord'      =>  'Duocai2015',

        'smtpSecure'    =>  'ssl',

        'port'          =>  465,

        'charSet'       =>  'utf-8',

        'from'          =>  'dev@duocai.cn',

        'fromName'      =>  APP_NAME . ' - 技术研发中心',

        'language'      =>  'zh-cn'

    ]
];