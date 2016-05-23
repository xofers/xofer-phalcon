<?php

/**
 *
 * @description :Dispatcher事件触发类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Events;

use Phalcon\Events\Event;
use Phalcon\Events\Manager;

class Dispatcher extends Manager
{
    /**
     * 在进入循环调度前触发。此时，调度器不知道将要执行的控制器或者动作是否存在。调度器只知道路由传递过来的信息
     *
     * @param Event $event
     */
    public function beforeDispatchLoop(Event $event)
    {
    }

    /**
     * 在进入循环调度后触发。此时，调度器不知道将要执行的控制器或者动作是否存在。调度器只知道路由传递过来的信息
     *
     * @param Event $event
     */
    public function beforeDispatch(Event $event)
    {
    }

    /**
     * 在执行控制器/动作方法前触发。此时，调度器已经初始化了控制器并知道动作是否存在
     *
     * @param Event $event
     */
    public function beforeExecuteRoute(Event $event)
    {
    }

    /**
     * 允许在请求中全局初始化控制器
     *
     * @param Event $event
     */
    public function initialize(Event $event)
    {
    }

    /**
     * 在执行控制器/动作方法后触发。由于此操作不可终止，所以仅在执行动作后才使用此事件进行清理工作
     *
     * @param Event $event
     */
    public function afterExecuteRoute(Event $event)
    {
    }

    /**
     * 当控制器中的动作找不到时触发
     *
     * @param Event $event
     */
    public function beforeNotFoundAction(Event $event)
    {
    }

    /**
     * 在调度器抛出任意异常前触发
     *
     * @param Event $event
     */
    public function beforeException(Event $event)
    {

    }

    /**
     * 在执行控制器/动作方法后触发。由于此操作不可终止，所以仅在执行动作后才使用此事件进行清理工作
     *
     * @param Event $event
     */
    public function afterDispatch(Event $event)
    {
    }

    /**
     * 在退出循环调度后触发
     *
     * @param Event $event
     */
    public function afterDispatchLoop(Event $event)
    {
    }
}