<?php

namespace Dc\Wechat;

use Phalcon\Mvc\Router;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;

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

        $loader->registerNamespaces(array(
            'Dc\Wechat\Controllers' => __DIR__ . '/controllers/',
            'Dc\Wechat\Models' => __DIR__ . '/models/',
        ));

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {

        //微信用户分组
        $wechatGroup = new Router\Group([
            "module" => "wechat",
            "controllers" => "index"
        ]);

        //定义视图
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            return $view;
        });
    }
}
