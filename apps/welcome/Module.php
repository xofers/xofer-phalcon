<?php

namespace App\Welcome;

use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        $services = loadFile(__DIR__ . '/Services.php')->toArray();

        array_walk($services, function ($v, $k) use ($di) {
            $di->set($k, $v);
        });
    }
}