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

use Dc\Lib\Log;
use Phalcon\Events\Event;
use Phalcon\Db\Adapter\Pdo\Mysql as DbMysql;

class Mysql
{
    /**
     * 当成功连接数据库之后触发
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function afterConnect(Event $event, DbMysql $mysql)
    {
    }

    /**
     * 在发送SQL到数据库前触发(可以停止操作)
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function beforeQuery(Event $event, DbMysql $mysql)
    {
        Log::info($mysql->getSQLStatement());
    }

    /**
     * 在发送SQL到数据库执行后触发
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function afterQuery(Event $event, DbMysql $mysql)
    {
    }

    /**
     * 在关闭一个暂存的数据库连接前触发
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function beforeDisconnect(Event $event, DbMysql $mysql)
    {
    }

    /**
     * 事务启动前触发
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function beginTransaction(Event $event, DbMysql $mysql)
    {
    }

    /**
     * 事务回滚前触发
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function rollbackTransaction(Event $event, DbMysql $mysql)
    {
    }

    /**
     * 事务提交前触发
     *
     * @param Event $event
     * @param DbMysql $mysql
     */
    public function commitTransaction(Event $event, DbMysql $mysql)
    {
    }

}