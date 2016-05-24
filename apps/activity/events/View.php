<?php

/**
 *
 * @description :视图事件触发类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace App\Activity\Events;

use Phalcon\Events\Event;
use Phalcon\Mvc\View as MvcView;

class View extends \Dc\Modules\Events\View
{
    /**
     * 渲染过程开始前触发(可以停止操作)
     *
     * @param Event $event
     * @param MvcView $view
     */
    public function beforeRender(Event $event, MvcView $view)
    {
        parent::beforeRender($event, $view);
    }

    /**
     * 渲染一个现有的视图之前触发(可以停止操作)
     *
     * @param Event $event
     * @param MvcView $view
     */
    public function beforeRenderView(Event $event, MvcView $view)
    {
        parent::beforeRenderView($event, $view);
    }

    /**
     * 渲染一个现有的视图之后触发(不可停止)
     *
     * @param Event $event
     * @param MvcView $view
     */
    public function afterRenderView(Event $event, MvcView $view)
    {
        parent::afterRenderView($event, $view);
    }

    /**
     * 渲染过程完成后触发(不可停止)
     *
     * @param Event $event
     * @param MvcView $view
     */
    public function afterRender(Event $event, MvcView $view)
    {
        parent::afterRender($event, $view);
    }

    /**
     * 视图不存在时触发(不可停止)
     *
     * @param Event $event
     * @param MvcView $view
     */
    public function notFoundView(Event $event, MvcView $view)
    {
        parent::notFoundView($event, $view);
    }
}