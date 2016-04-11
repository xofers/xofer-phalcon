<?php
/**
 *
 * @description :Environment
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/9 0009 17:12
 *
 */
namespace Dc\Module;

use Phalcon\Cli\Environment\EnvironmentAwareInterface;
use Phalcon\Cli\Environment\EnvironmentInterface;
use Phalcon\Di\FactoryDefault\Cli as CliDi;
use Phalcon\Cli\Console as PhConsole;
use Phalcon\DiInterface;

class Console extends PhConsole implements EnvironmentAwareInterface
{
    protected $environment;

    public function __construct(DiInterface $di = null)
    {
        $di = $di ?: new CliDi;

        parent::__construct($di);
    }

    public function setEnvironment(EnvironmentInterface $environment)
    {
        $this->environment = $environment;

        return $this;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }
}