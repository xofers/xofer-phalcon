<?php
/**
 *
 * @description :服务加载
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 *
 */

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$di = new FactoryDefault();

/**
 * 注入配置
 */
$di->set('config', function () {

    $configDir = APP_PATH . '/config/';
    $configDir .= IS_DEV ? 'dev/' : '';

    $config = loadDir($configDir);
    if (IS_DEV !== false && IS_DEV != 'dev') {
        $config = loadDir(APP_PATH . '/config/' . IS_DEV . '/', $config);
    }

    return $config;
});

$config = $di->get('config');

/**
 * 注入调试模块
 */
$di->setShared('debug', function () {
    $debugbar = new \Snowair\Debugbar\ServiceProvider(\Phalcon\Di::getDefault()->get('config')->debugbar);
    return $debugbar;
});

/**
 * 注入应用
 */
$di->setShared('app', function () use (
    $di,
    $config
) {
    $application = new Application($di);
    $application->registerModules(loadFile(APP_PATH . '/apps/modules.php')->toArray());

    $eventsManager = new EventsManager();
    $application->setEventsManager($eventsManager);

    return $application;
});

/**
 * 注入路由
 */
$di->set('router', function () {

    $router = new Router(false);
    $router->setDefaultModule('welcome');

    //设置模块的默认路由
    $module = array_flip(array_keys(loadFile(APP_PATH . '/apps/modules.php')->toArray()));

    array_walk($module, function ($val, $key, $router) {
        $router->add(
            "/{$key}",
            [
                'controller' => 'index',
                'action' => 'index',
                'module' => $key,
                'namespace' => 'Dc\\' . ucfirst($key) . '\Controllers'
            ]
        );
        $router->add(
            "/{$key}/:controller",
            [
                'controller' => 1,
                'action' => 'index',
                'module' => $key,
                'namespace' => 'Dc\\' . ucfirst($key) . '\Controllers'
            ]
        );
        $router->add(
            "/{$key}/:controller/:action",
            [
                'controller' => 1,
                'action' => 2,
                'module' => $key,
                'namespace' => 'Dc\\' . ucfirst($key) . '\Controllers'
            ]
        );
    }, $router);

    //设置自定义路由
    $myRouters = loadFile(APP_PATH . '/apps/routers.php')->toArray();
    if (!empty($myRouters)) {
        array_walk($myRouters, function ($val, $key, $router) {
            $router->add($key, $val);
        }, $router);
    }

    //处理结尾额外的斜杆
    $router->removeExtraSlashes(true);

    return $router;
});

/**
 * 注入调度器
 */
$di->set('dispatcher', function () use ($config) {

    $dispatcher = new Dispatcher();
    $eventsManager = new EventsManager();

    $eventsManager->attach("dispatch:beforeExecuteRoute", function ($event, $dispatcher, $exception) use ($config) {
        define("MODULE_NAME", $dispatcher->getModuleName());
        define("ACTION_NAME", $dispatcher->getActionName());
    });

    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace("Dc\Welcome\Controllers");

    return $dispatcher;
});

/**
 * 注入日志系统
 */
$di->set('logger', function () use ($config) {

    $logger = new Monolog\Logger(MODULE_NAME);
    $config->log->file = str_replace('MODULE_NAME', MODULE_NAME, $config->log->file);
    $logger->pushHandler(new Monolog\Handler\StreamHandler($config->log->file, $config->log->level));

    return $logger;
});

/**
 * 注入视图系统
 */
$di->set('view', function () {
    $view = new View();

    return $view;
});

/**
 * 注入数据库系统-写
 */
$di->setShared('dbWrite', function () use ($config) {
    return new DbAdapter($config->db_w->toArray());
});

/**
 * 注入数据库系统-读
 */
$di->setShared('dbRead', function () use ($config) {
    return new DbAdapter($config->db_r->toArray());
});

/**
 * 注入session
 */
$di->set('redisSession', function () use ($config) {
    $session = new Predis\Client(
        $config->redis->toArray(),
        [
            'replication' => true,

            'prefix' => '_DCWX_SESSIONS_' . strtoupper(MODULE_NAME) . '_'
        ]
    );
    $handler = new Predis\Session\Handler($session, ['gc_maxlifetime' => 86400]);
    $handler->register();

    return $session;
});

/**
 * 注入缓存系统
 */
$di->set('cache', function () use ($config) {
    return new Predis\Client(
        $config->redis->toArray(),
        [
            'replication' => true,

            'prefix' => '_DCWX_CACHE_' . strtoupper(MODULE_NAME) . '_'
        ]
    );
});