<?php

namespace Dc\Wechat;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Dc\Wechat\Controllers' => __DIR__ . '/controllers/',
            'Dc\Lib' => __DIR__ . '/../../library/',
        ]);

        $loader->registerDirs([
            __DIR__ . '/models/'
        ], true);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {


        $di->set('view',function(){

            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        });
    }
}
