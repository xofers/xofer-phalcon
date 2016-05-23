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
use Phalcon\Events\Manager;

class Mysql extends Manager
{
    /**
     * 当成功连接数据库之后触发
     *
     * @param Event $event
     */
    public function afterConnect(Event $event)
    {
    }

    /**
     * 在发送SQL到数据库前触发(可以停止操作)
     *
     * @param Event $event
     */
    public function beforeQuery(Event $event)
    {
    }

    /**
     * 在发送SQL到数据库执行后触发
     *
     * @param Event $event
     */
    public function afterQuery(Event $event)
    {
    }

    /**
     * 在关闭一个暂存的数据库连接前触发
     *
     * @param Event $event
     */
    public function beforeDisconnect(Event $event)
    {
    }

    /**
     * 事务启动前触发
     *
     * @param Event $event
     */
    public function beginTransaction(Event $event)
    {
    }

    /**
     * 事务回滚前触发
     *
     * @param Event $event
     */
    public function rollbackTransaction(Event $event)
    {
    }

    /**
     * 事务提交前触发
     *
     * @param Event $event
     */
    public function commitTransaction(Event $event)
    {
    }

}