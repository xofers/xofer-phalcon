<?php
define('APP_NAME', '多彩换新');
define('APP_PATH', realpath('..'));
define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define("IS_DEV", isset($_SERVER['DC_ENV']) && in_array($_SERVER['DC_ENV'], ['dev', 'local']) ? $_SERVER['DC_ENV'] : false);

//引入包资源
require_once '../vendor/autoload.php';

try {
    //加载服务
    require_once '../apps/services.php';

    //加载调试工具
    if (IS_DEV && IS_DEV != 'dev') {
        $handler = PhpConsole\Handler::getInstance();
        $connector = PhpConsole\Connector::getInstance();
        $connector->setPassword('*****');
        $connector->startEvalRequestsListener();
        $handler->start();
    }

    //处理请求
    echo \Phalcon\Di::getDefault()->get('app')->handle()->getContent();
} catch (\Exception $e) {

    echo $e->getMessage(), PHP_EOL;
    echo $e->getTraceAsString();
}