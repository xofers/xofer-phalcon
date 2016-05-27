<?php
/**
 *
 * @description :服务的事件管理
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/27 0027 0:11
 *
 */

namespace Dc\Lib\Traits;

trait ServiceEvents
{
    /**
     * @var \Dc\Modules\Events\Dispatcher
     */
    protected $_event;

    public function setEvent($event)
    {
        $this->_event = $event;
    }

    public function getEvent()
    {
        return $this->_event;
    }
}