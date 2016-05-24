<?php

/**
 *
 * @description :调度服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;

use Dc\Modules\Events;
use Phalcon\Events\Manager as EventsManager;

class Dispatcher extends \Phalcon\Mvc\Dispatcher
{
    public function __construct()
    {
        parent::__construct();

        $eventManager = new EventsManager();
        $eventManager->attach('dispatch',new Events\Dispatcher());
        $this->setEventsManager($eventManager);
    }

}