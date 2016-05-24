<?php
/**
 *
 * @description :模块管理
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:05
 *
 */

namespace Dc\Modules;

use Dc\Modules\Events;
use Phalcon\Di\Service;
use Phalcon\Mvc\Application;
use Phalcon\Events\Manager as EventsManager;

class Manager
{
    public $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function registerService()
    {
        $services = loadFile(__DIR__ . '/Services.php')->toArray();

        array_walk($services, function ($v, $k) {
            $this->app->di->setShared($k, $v);
        });

    }

    public function getApplication(){
        return $this->app;
    }

    protected function registerEvents()
    {
        $eventManager = new EventsManager();
        $eventManager->attach('di', new Events\Di());
        $this->app->di->setInternalEventsManager($eventManager);

        $eventManager->attach('application', new Events\Application());
        $this->app->setEventsManager($eventManager);

    }

    protected function registerModules()
    {
        $this->app->registerModules(loadFile(__DIR__ . '/modules.php')->toArray());
    }

    public function handle()
    {
        $this->registerService();

        $this->registerModules();

        $this->registerEvents();

    }
}

