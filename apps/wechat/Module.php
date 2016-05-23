<?php

namespace App\Wechat;

use Predis;
use Phalcon\Di;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\DiInterface;
use Doctrine\Common\Cache\PredisCache;
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

        //注入微信应用的实例
        $di->set('wechat', function () use ($di, $config) {
            $wechat = new Application($config->wechat->toArray());

            //设置微信缓存
            $wechat->cache = new PredisCache($di->get('cache'));

            return $wechat;
        }, true);
    }
}
