<?php
use Phalcon\Mvc\Application;

define('APP_PATH', realpath('..'));
define('APP_NAME', '多彩换新');
define('ROOT_PATH', __DIR__.DIRECTORY_SEPARATOR);
define("IS_DEV",isset($_SERVER['DC_ENV']) && in_array($_SERVER['DC_ENV'], ['dev', 'local'])?true:false);

try {
    //引入包资源
    require_once '../vendor/autoload.php';

    //加载服务
    require '../config/services.php';

    //创建应用
    $application = new Application($di);

    //注册模块
    $modules = require_once '../config/modules.php';
    $application->registerModules($modules->toArray());

    //处理请求
    echo $application->handle()->getContent();
} catch (\Exception $e) {

    echo $e->getMessage(), PHP_EOL;
    echo $e->getTraceAsString();
}