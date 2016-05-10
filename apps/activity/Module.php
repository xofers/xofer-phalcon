<?php

namespace Dc\Activity;

use Predis;
use Phalcon\Di;
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
            'Dc\Activity\Controllers' => __DIR__ . '/controllers/',
        ]);

        $loader->registerDirs([
            __DIR__ . '/model/'
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
    }
}
