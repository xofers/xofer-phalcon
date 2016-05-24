<?php

/**
 *
 * @description :PhpStorm
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;

use Dc\Modules\Events;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as MysqlAdapter;

class Mysql extends MysqlAdapter
{
    public function __construct(array $descriptor = null, $config = null)
    {
        parent::__construct($config->{current($descriptor)}->toArray());

        $eventManager = new EventsManager();
        $eventManager->attach('db', new Events\Mysql());
        $this->setEventsManager($eventManager);
    }
}