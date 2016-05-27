<?php

/**
 *
 * @description :视图事件触发类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace App\Welcome\Events;

use Phalcon\Events\Event;

class View extends \Dc\Modules\Events\View
{
    /**
     * 渲染过程开始前触发(可以停止操作)
     *
     * @param Event $event
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }

    /**
     * 渲染一个现有的视图之前触发(可以停止操作)
     *
     * @param Event $event
     */
    public function beforeRenderView(Event $event)
    {
        parent::beforeRenderView($event);
    }

    /**
     * 渲染一个现有的视图之后触发(不可停止)
     *
     * @param Event $event
     */
    public function afterRenderView(Event $event)
    {
        parent::afterRenderView($event);
    }

    /**
     * 渲染过程完成后触发(不可停止)
     *
     * @param Event $event
     */
    public function afterRender(Event $event)
    {
        parent::afterRender($event);
    }

    /**
     * 视图不存在时触发(不可停止)
     *
     * @param Event $event
     */
    public function notFoundView(Event $event)
    {
        parent::notFoundView($event);
    }
}