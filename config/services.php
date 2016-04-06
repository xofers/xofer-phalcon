<?php
/**
 * Services are globally registered in this file
 */
use Phalcon\Mvc\View,
    Phalcon\Mvc\Router,
    Phalcon\config\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\DI\FactoryDefault;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a config
 */
$di->set('config',function(){

    $dir    = APP_DEBUG ? 'dev/' : 'online/';
    $config = Loader::loadDir(APP_PATH.'/config/'. $dir);

    return $config;
});

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
$di['view'] = function() {

    $view = new View();
    return $view;
};