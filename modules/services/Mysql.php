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
use Phalcon\Db\Adapter\Pdo\Mysql as MysqlAdapter;

class Mysql extends MysqlAdapter
{
    public function __construct(array $descriptor = null,$config = null)
    {
        $this->setEventsManager(new Events\Mysql());

        parent::__construct($config->{current($descriptor)}->toArray());

    }
}