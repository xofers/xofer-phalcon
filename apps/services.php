<?php
/**
 * Services are globally registered in this file
 */
use Phalcon\Mvc\View,
    Phalcon\Mvc\Router,
    Phalcon\Config\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\DI\FactoryDefault,
    Phalcon\Events\Manager as EventsManager,
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a config
 */
$di->set('config',function(){

    $configDir = APP_PATH.'/config/';
    $configDir .= IS_DEV ?'dev/': '';
    $config = Loader::loadDir($configDir);

    !IS_DEV || IS_DEV == 'dev'?:$config->merge(Loader::loadDir(APP_PATH.'/config/'.IS_DEV.'/'));
    return $config;
});

/**
 * get all config
 */
$config = $di->get('config');

/**
 * Registering a router
 */
$di->set('router',function(){

    $router = new Router(false);
    $router->setDefaultModule("welcome");

    //设置模块的默认路由
    $module = array_flip(array_keys(Loader::load(APP_PATH.'/apps/modules.php')->toArray()));

    array_walk($module,function($val,$key,$router){
        $router->add('/'.$key,['controller'=> 'index','action' => 'index', 'module'=>$key,'namespace'=>'Dc\\'.ucfirst($key).'\Controllers']);
        $router->add('/'.$key.'/:controller',['controller'=> 1,'action' => 'index','module'=>$key,'namespace'=>'Dc\\'.ucfirst($key).'\Controllers']);
        $router->add('/'.$key.'/:controller/:action',['controller'=> 1,'action' => 2, 'module'=>$key,'namespace'=>'Dc\\'.ucfirst($key).'\Controllers']);
    },$router);

    //设置自定义路由
    $myRouters = Loader::load(APP_PATH.'/apps/routers.php')->toArray();
    if(!empty($myRouters)){
        array_walk($myRouters,function($val,$key,$router){
            $router->add($key,$val);
        },$router);
    }

    //处理结尾额外的斜杆
    $router->removeExtraSlashes(true);

    return $router;
});

/**
 * Registering a dispatcher
 */
$di->set('dispatcher',function () use ($config) {

    $dispatcher     = new Dispatcher();
    $eventsManager  = new EventsManager();

    $eventsManager->attach("dispatch:beforeExecuteRoute", function ($event, $dispatcher, $exception) use ($config) {
        define("MODULE_NAME",$dispatcher->getModuleName());
        define("ACTION_NAME",$dispatcher->getActionName());
    });

    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace("Dc\Welcome\Controllers");

    return $dispatcher;
});

/**
 * Registering a logger
 */
$di->set('logger',function () use($config) {

    $logger = new Monolog\Logger(MODULE_NAME);
    $config->log->file = str_replace('MODULE_NAME',MODULE_NAME,$config->log->file);
    $logger->pushHandler(new Monolog\Handler\StreamHandler($config->log->file,$config->log->level));

    return $logger;
});

/**
 * Registering a view
 */
$di->set('view',function () {

    $view = new View();
    return $view;
});

/**
 * Registering a mysql write connnect
 */
$di->setShared('dbWrite', function() use ($config) {
    return new DbAdapter($config->db_w->toArray());
});

/**
 * Registering a mysql read connnect
 */
$di->setShared('dbRead', function() use ($config) {
    return new DbAdapter($config->db_r->toArray());
});

/**
 * Registering a session
 */
$di->set('session', function() use ($config) {

    $session = new Predis\Client($config->redis->toArray(), ['replication' => true,'prefix' => '_DCWX_SESSIONS_'.strtoupper(MODULE_NAME).'_']);
    $handler = new Predis\Session\Handler($session,['gc_maxlifetime'=>86400]);
    $handler->register();

    return $session;
});

/**
 * Registering a read cache
 */
$di->set('cache', function () use ($config) {

    $cache = new Predis\Client($config->redis->toArray(), ['replication' => true,'prefix' => '_DCWX_CACHE_'.strtoupper(MODULE_NAME).'_']);

    return $cache;
});