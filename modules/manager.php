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

    /**
     * 注册基础服务
     */
    protected function registerService()
    {
        $services = loadFile(__DIR__ . '/Services.php')->toArray();

        array_walk($services, function ($v, $k) {
            $this->app->di->setShared($k, $v);
        });

    }

    /**
     * 注册DI与Application事件
     */
    protected function registerEvents()
    {
        $eventManager = new EventsManager();
        $eventManager->attach('di', new Events\Di());
        $this->app->di->setInternalEventsManager($eventManager);

        $eventManager->attach('application', new Events\Application());
        $this->app->setEventsManager($eventManager);

    }

    /**
     * 注册模块
     */
    protected function registerModules()
    {
        $this->app->registerModules(loadFile(__DIR__ . '/modules.php')->toArray());
    }

    /**
     * 模块管理器处理
     */
    public function handle()
    {
        $this->registerService();

        $this->registerModules();

        $this->registerEvents();

    }
}

