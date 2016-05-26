<?php

/**
 *
 * @description :视图服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace App\Welcome\Services;

use App\Welcome\Events;
use Phalcon\Events\Manager as EventsManager;

class View extends \Phalcon\Mvc\View
{
    public function __construct($options = null)
    {
        parent::__construct($options);

        $this->setViewsDir(__DIR__.'/../views/');

        $eventManager = new EventsManager();
        $eventManager->attach('view', new Events\View());
        $this->setEventsManager($eventManager);
    }
}