<?php

/**
 * @description :日志记录类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-04-07
 */

namespace Dc\Lib;

use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\NullHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class Log.
 */
class Log
{
    /**
     * Logger instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected static $logger;

    /**
     * Return the logger instance.
     *
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger()
    {
        return self::$logger ?: self::$logger = self::createDefaultLogger();
    }

    /**
     * Set logger.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    /**
     * Tests if logger exists.
     *
     * @return bool
     */
    public static function hasLogger()
    {
        return self::$logger ? true : false;
    }

    /**
     * Forward call.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return forward_static_call_array([self::getLogger(), $method], $args);
    }

    /**
     * Forward call.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([self::getLogger(), $method], $args);
    }

    /**
     * Make a default log instance.
     *
     * @return \Monolog\Logger
     */
    private static function createDefaultLogger()
    {
        $log = new Logger('EasyWeChat');

        if (defined('PHPUNIT_RUNNING')) {
            $log->pushHandler(new NullHandler());
        } else {
            $log->pushHandler(new ErrorLogHandler());
        }

        return $log;
    }
}



