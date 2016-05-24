<?php

/**
 *
 * @description :应用事件触发类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Events;

use Phalcon\Events\Event;

class Application
{
    /**
     * 当应用处理它首个请求时触发
     *
     * @param Event $event
     */
    public function boot(Event $event)
    {
    }

    /**
     * 在初始化模块之前，仅当模块被注册时触发
     *
     * @param Event $event
     */
    public function beforeStartModule(Event $event)
    {
        define('MODULE_NAME', $event->getData());
    }

    /**
     * 在初始化模块之后，仅当模块被注册时
     *
     * @param Event $event
     */
    public function afterStartModule(Event $event)
    {
    }

    /**
     * 在执行分发环前触发
     *
     * @param Event $event
     */
    public function beforeHandleRequest(Event $event)
    {
    }

    /**
     * 在执行分发环后触发
     *
     * @param Event $event
     */
    public function afterHandleRequest(Event $event)
    {
    }
}