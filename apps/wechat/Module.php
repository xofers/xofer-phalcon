<?php

namespace Dc\Wechat;

use Predis;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\DiInterface;
use EasyWeChat\Foundation\Application;
use Phalcon\Config\Loader as ConfigLoader;
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
        //加载对应模块下的配置
        $config = $di->get('config');
        $moduleConfig = ConfigLoader::loadDir(IS_DEV ?__DIR__.'/config/dev/': __DIR__.'/config/');
        $config->merge($moduleConfig);
        !IS_DEV || IS_DEV=='dev' ?: $config->merge(ConfigLoader::loadDir(__DIR__.'/config/'.IS_DEV.'/'));

        $di->set('config',function() use($config){
            return $config;
        },true);

        //注入微信应用的实例
        $di->set('wechat',function() use($config){
            $wechat = new Application($config->wechat->toArray());

            return $wechat;
        },true);

        $di->set('view',function(){

            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        });
    }
}
