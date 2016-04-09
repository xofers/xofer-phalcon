<?php

/**
 *
 * @description :正式环境-memcached配置文件
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

$_SERVER = array_map('trim', $_SERVER);
$mc_pool = [];
if (isset($_SERVER['DC_MEMCACHED_HOST'])) {
    $mc_env = $_SERVER['DC_MEMCACHED_HOST'];
    $mc_env = explode(',', $mc_env);
    if (!empty($mc_env)) {
        foreach ($mc_env as $value) {
            $tmp = explode(':', trim($value));
            $mc_pool[] = [
                'host' => $tmp[0],
                'port' => $tmp[1],
                'weight' => 1
            ];
        }
    }
}

return [
    'memcached' =>   $mc_pool
];

