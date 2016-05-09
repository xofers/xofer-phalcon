<?php

namespace Dc\Wechat;

use Predis;
use Dc\Lib\Helper;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\DiInterface;
use EasyWeChat\Foundation\Application;
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
        $di->set('config',function() use($config){
            $config = Helper::loadDir(IS_DEV ?__DIR__.'/config/dev/': __DIR__.'/config/',$config);
            if(IS_DEV !== false && IS_DEV != 'dev'){
                $config = Helper::loadDir(__DIR__.'/config/'.IS_DEV.'/',$config);
            }
            return $config;
        });

        //注入微信应用的实例
        $di->set('wechat',function() use($config){
            $wechat = new Application($config->wechat->toArray());

            return $wechat;
        },true);

    }
}
