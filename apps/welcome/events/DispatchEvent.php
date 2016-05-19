<?php
/**
 *
 * @description :Dipatch事件管理
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/19 0019 9:05
 *
 */
namespace Dc\Welcome\Events;

use Phalcon\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher\Exception;

class DispatchEvent
{

    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {

    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        define("MODULE_NAME", $dispatcher->getModuleName());
        define("ACTION_NAME", $dispatcher->getActionName());
    }
}