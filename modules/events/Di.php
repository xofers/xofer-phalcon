<?php

/**
 *
 * @description :DI事件触发类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Events;

use Phalcon\Events\Event;
use Phalcon\Events\Manager;

class Di
{
    /**
     * 解决服务之前事件触发
     *
     * @param Event $event
     */
    public function beforeServiceResolve(Event $event)
    {

    }

    /**
     * 解决服务之后事件触发
     *
     * @param Event $event
     */
    public function afterServiceResolve(Event $event)
    {
        /**
         * 绑定各个服务的事件
         */
        $service = $event->getData()['instance'];

        if (property_exists($service, 'attachName')) {
            $eventManager = empty($eventManager) ? new Manager() : $service->getEventsManager();
            $eventManager->attach($service->attachName, $service->getEvent());
            $service->setEventsManager($eventManager);
        }
    }
}