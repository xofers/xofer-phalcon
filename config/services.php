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
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
    Phalcon\Session\Adapter\Libmemcached as Session;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a config
 */
$di->setShared('config',function(){

    $dir    = IS_DEV ? 'dev/' : 'online/';
    $config = Loader::loadDir(APP_PATH.'/config/'. $dir);

    return $config;
});

/**
 * get all config
 */
$config = $di->getShared('config');

/**
 * Registering a router
 */
$di->set('router',function(){

    $router = new Router(false);
    $router->setDefaultModule("welcome");

    //设置模块的默认路由
    $module = array_flip(array_keys(Loader::load(APP_PATH.'/config/modules.php')->toArray()));
    array_walk($module,function($val,$key,$router){
        $router->add('/'.$key,['controller'=> 'index','action' => 'index', 'module'=>$key,'namespace'=>'Dc\\'.ucfirst($key).'\Controllers']);
        $router->add('/'.$key.'/:controller',['controller'=> 1,'action' => 'index','module'=>$key,'namespace'=>'Dc\\'.ucfirst($key).'\Controllers']);
        $router->add('/'.$key.'/:controller/:action',['controller'=> 1,'action' => 2, 'module'=>$key,'namespace'=>'Dc\\'.ucfirst($key).'\Controllers']);
    },$router);

    //设置自定义路由
    $myRouters = Loader::load(APP_PATH.'/config/routers.php')->toArray();
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

    //加载各模块下对应的配置文件
    $eventsManager->attach("dispatch:beforeExecuteRoute", function ($event, $dispatcher, $exception) use ($config) {
        $moduleConfig = Loader::loadDir(APP_PATH.'/apps/'.$dispatcher->getModuleName().'/config/');
        $config->merge($moduleConfig);
    });

    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace("Dc\Welcome\Controllers");

    return $dispatcher;
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
    print_r($config->db_w->toArray());
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

    $session = new Session([
        'servers' => $config->memcached->toArray(),
        'client' => [
            \Memcached::OPT_HASH => \Memcached::HASH_MD5,
            \Memcached::OPT_PREFIX_KEY => '_DCWX',
        ],
        'lifetime' => 86400,
        'prefix' => '_SESSION_', //实际整体前缀是：_DCWX_SESSION_
    ]);

    $session->start();

    return $session;
});

/**
 * Registering a model cache
 */
$di->set('cacheModel', function () use ($config) {

    $frontCache = new \Phalcon\Cache\Frontend\Data([
        'lifetime' => 86400,
    ]);

    $cache = new \Phalcon\Cache\Backend\Libmemcached($frontCache, [
        'servers' => $config->memcached->toArray(),
        'client' => [
            \Memcached::OPT_HASH => \Memcached::HASH_MD5,
            \Memcached::OPT_PREFIX_KEY => '_DCWX',
        ],
        'prefix' => '_CACHE_MODEL__'
    ]);

    return $cache;
});