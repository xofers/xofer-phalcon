<?php
/**
 * Services are globally registered in this file
 */
use Phalcon\Mvc\View,
    Phalcon\Mvc\Router,
    Phalcon\config\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\DI\FactoryDefault,
    Phalcon\Session\Adapter\Libmemcached as Session,
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a config
 */
$di->setShared('config',function(){

    $dir    = APP_DEBUG ? 'dev/' : 'online/';
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
$di->set('dispatcher',function () {

    $dispatcher = new Dispatcher();
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

    $session = new Session(array(
        'servers' => $config->memcached->toArray(),
        'client' => array(
            \Memcached::OPT_HASH => \Memcached::HASH_MD5,
            \Memcached::OPT_PREFIX_KEY => '_DCWX',
        ),
        'lifetime' => 86400,
        'prefix' => '_SESSION_', //实际整体前缀是：_DCWX_SESSION_
    ));

    $session->start();

    return $session;
});

/**
 * Registering a model cache
 */
$di->set('modelsCache', function () use ($config) {

    $frontCache = new \Phalcon\Cache\Frontend\Data(array(
        'lifetime' => 86400,
    ));

    $cache = new \Phalcon\Cache\Backend\Libmemcached($frontCache, array(
        'servers' => $config->memcached->toArray(),
        'client' => array(
            \Memcached::OPT_HASH => \Memcached::HASH_MD5,
            \Memcached::OPT_PREFIX_KEY => '_DCWX',
        ),
        'prefix' => '_MODEL_CACHE_',
    ));

    return $cache;
});

