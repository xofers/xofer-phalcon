<?php
use Phalcon\Mvc\Application;

define('APP_PATH', realpath('..'));
define('APP_NAME', '多彩换新');
define('APP_DEBUG', true);
define('ROOT_PATH', __DIR__.DIRECTORY_SEPARATOR);
define("IS_DEV",isset($_SERVER['DC_ENV']) && in_array($_SERVER['DC_ENV'], ['dev', 'local'])?true:false);

try {
    //引入包资源
    require_once APP_PATH.'/vendor/autoload.php';

    echo (new \Phalcon\Version())->get();

    //加载服务
    require_once APP_PATH.'/config/services.php';

    //创建应用
    $application = new Application($di);

    //注册模块
    $application->registerModules(\Phalcon\Config\Loader::load(APP_PATH.'/config/modules.php')->toArray());

    //开启debugar
    if(APP_DEBUG && IS_DEV){
        $di->set('app',$application);
        $di->set('config.debugbar',$di->get('config')->debugbar);
        $debugbar = new Snowair\Debugbar\ServiceProvider($di['config.debugbar']);
        $debugbar->start();
    }

    //处理请求
    echo $application->handle()->getContent();
} catch (\Exception $e) {

    echo $e->getMessage(), PHP_EOL;
    echo $e->getTraceAsString();
}