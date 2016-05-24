<?php

/**
 *
 * @description :基础配置服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;

use Dc\Modules\Events;
use Phalcon\Events\Manager as EventsManager;

class Router extends \Phalcon\Mvc\Router
{

    public function __construct($defaultRoutes = true)
    {
        parent::__construct($defaultRoutes);

        $eventManager = new EventsManager();
        $eventManager->attach('router', new Events\Router());
        $this->setEventsManager($eventManager);

        $this->setDefaultNamespace('App\\Welcome\\Controllers');

        $routers = loadDir(__DIR__ . '/../routers/')->toArray();

        foreach ($routers as $k => $v) {

            //注册模块基础路由
            $this->registerModuleRouter($k);

            //注册自定义路由
            foreach ($v as $key => $val) {
                $httpMethod = empty($val['httpMethod']) ? null : $val['httpMethod'];
                $position = empty($val['position']) ? \Phalcon\Mvc\Router::POSITION_LAST : $val['position'];

                unset($val['httpMethod']);
                unset($val['position']);

                $this->add(
                    $key,
                    array_merge(['module' => $k, 'namespace' => 'App\\' . ucfirst($k) . '\\Controllers'], $val),
                    $httpMethod,
                    $position
                );
            }
        }

        $this->removeExtraSlashes(true);

    }

    /**
     * 注册模块的默认路由
     *
     * @param $module
     */
    protected function registerModuleRouter($module)
    {
        $this->add("/{$module}",
            [
                'controller' => 'index',
                'action' => 'index',
                'module' => $module,
                'namespace' => 'App\\' . ucfirst($module) . '\\Controllers'
            ]
        );
        $this->add("/{$module}/([\\x00-\\xff]+)",
            [
                'controller' => 1,
                'action' => 'index',
                'module' => $module,
                'namespace' => 'App\\' . ucfirst($module) . '\\Controllers'
            ]
        );
        $this->add("/{$module}/([\\x00-\\xff]+)/([\\x00-\\xff]+)",
            [
                'controller' => 1,
                'action' => 2,
                'module' => $module,
                'namespace' => 'App\\' . ucfirst($module) . '\\Controllers'
            ]
        );
        $this->add("/{$module}/:controller/:action/:params",
            [
                'controller' => 1,
                'action' => 2,
                'params' => 3,
                'module' => $module,
                'namespace' => 'App\\' . ucfirst($module) . '\\Controllers'
            ]
        );
    }
}