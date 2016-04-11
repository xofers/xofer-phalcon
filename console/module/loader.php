<?php
/**
 *
 * @description :注册类自动加载
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/9 0009 17:54
 *
 */

$loader = new \Phalcon\Loader();

$loader->registerDirs([
    APP_PATH . '/console/task'
],true);

$loader->registerNamespaces(array(
    'Dc\Modules' => __DIR__ . '/../lib/',
    'Dc\Lib\Models' => __DIR__ . '/../lib/models',
    'Dc\Lib\Plugin' => __DIR__ . '/../lib/plugin',
    'Dc\Lib\Tool' => __DIR__ . '/../lib/tool',
    'Dc\Lib\Wx' => __DIR__ . '/../lib/wx',
    'Dc\Lib\Erp' => __DIR__ . '/../lib/erp',
));

$loader->register();