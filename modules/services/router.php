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

class Router extends \Phalcon\Mvc\Router
{

    public function __construct($defaultRoutes = true, $modules = [])
    {
        parent::__construct($defaultRoutes);

        $this->setDefaultNamespace('App\\Welcome\Controllers');

        array_map(function ($module) {
            $this->registerModuleRouter($module);
        }, $modules);

        $this->removeExtraSlashes(true);
    }

    /**
     * 注册模块的默认路由
     *
     * @param string $module
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
        $this->add("/{$module}/:controller",
            [
                'controller' => 1,
                'action' => 'index',
                'namespace' => 'App\\' . ucfirst($module) . '\\Controllers'
            ]
        );
        $this->add("/{$module}/:controller/:action",
            [
                'controller' => 1,
                'action' => 2,
                'namespace' => 'App\\' . ucfirst($module) . '\\Controllers'
            ]
        );
    }
}