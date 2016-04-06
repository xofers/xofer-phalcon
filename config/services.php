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

    $loader = new Loader();
    $dir    = IS_DEV ? 'dev/' : 'online/';
    $config = $loader->loadDir(APP_PATH.'/config/'. $dir);

    return $config;
});

/**
 * Registering a router
 */
$di->set('router',function(){

    $router = new Router();
    $router->setDefaultModule("welcome");

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