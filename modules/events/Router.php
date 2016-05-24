<?php

/**
 *
 * @description :MYSQL事件触发类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Events;

use Phalcon\Events\Event;

use Dc\Modules\Services\Router as MvcRouter;

class Router
{
    /**
     * 检查所有路由之前触发
     *
     * @param Event $event
     * @param MvcRouter $router
     */
    public function beforeCheckRoutes(Event $event, MvcRouter $router)
    {
    }

    /**
     * 检查单个路由之前触发
     *
     * @param Event $event
     * @param MvcRouter $router
     */
    public function beforeCheckRoute(Event $event, MvcRouter $router)
    {
    }

    /**
     * 匹配路由之后触发
     *
     * @param Event $event
     * @param MvcRouter $router
     */
    public function matchedRoute(Event $event, MvcRouter $router)
    {

    }

    /**
     * 未匹配路由之后触发
     *
     * @param Event $event
     * @param MvcRouter $router
     */
    public function notMatchedRoute(Event $event, MvcRouter $router)
    {

    }

    /**
     * 检查所有路由之后触发
     *
     * @param Event $event
     * @param MvcRouter $router
     */
    public function afterCheckRoutes(Event $event, MvcRouter $router)
    {
    }
}