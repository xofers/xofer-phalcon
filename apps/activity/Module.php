<?php

namespace Dc\Activity;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

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
            'Dc\Activity\Controllers' => __DIR__ . '/controllers/',
            'Dc\Activity\Models' => __DIR__ . '/models/',
            'Dc\Activity\Repositories' => __DIR__ . '/repositories/'
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        //加载对应模块下的配置
        $config = $di->get('config');
        $di->set('config', function () use ($config) {
            $config = loadDir(IS_DEV ? __DIR__ . '/config/dev/' : __DIR__ . '/config/', $config);
            if (IS_DEV !== false && IS_DEV != 'dev') {
                $config = loadDir(__DIR__ . '/config/' . IS_DEV . '/', $config);
            }
            return $config;
        });
        $config = $di->get('config');

        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir(__DIR__.'/views/');

            return $view;
        });
    }
}