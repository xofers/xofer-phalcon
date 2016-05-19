<?php

namespace Dc\Welcome;

use Phalcon\Mvc\Router;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Dc\Welcome\Events;
use Phalcon\Events\Manager as EventsManager;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        (new Loader())
            ->registerNamespaces([
                'Dc\Welcome' => __DIR__
            ])
            ->registerDirs([

            ])
            ->registerClasses([

            ])
            ->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * 调度器
         */
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Dc\\Welcome\\Controllers');

            $eventsManager = new EventsManager();
            $eventsManager->attach('dispatch', new Events\DispatchEvent());
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}