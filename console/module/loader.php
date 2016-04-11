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
    APP_PATH . '/console/tasks'
],true);

$loader->registerNamespaces(array(
    'Dc\Module' => APP_PATH . '/console/module/',
));

$loader->register();