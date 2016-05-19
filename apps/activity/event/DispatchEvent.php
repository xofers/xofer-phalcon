<?php
/**
 *
 * @description :Dipatch事件管理
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/19 0019 9:05
 *
 */
namespace Dc\Activity\Event;

use Phalcon\Events\Event;

class DispatcherEvent
{
    public function beforeException(Event $event, $dispatcher, $exception)
    {

    }

}