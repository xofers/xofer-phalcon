<?php

/**
 * @description :日志记录类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-04-07
 */

namespace Dc\Lib;

use Phalcon\Di,
    Monolog\Logger,
    Psr\Log\LoggerInterface,
    Monolog\Handler\ErrorLogHandler;

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
     * @param string $fileType
     *
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger($fileType = '')
    {
        return self::$logger ?: self::$logger = self::createDefaultLogger($fileType);
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
     * Make a default log instance.
     *
     * @param string $fileType
     *
     * @return \Monolog\Logger
     */
    private static function createDefaultLogger($fileType = '')
    {

        $logger = Di::getDefault()->getShared("logger", [
            Di::getDefault()->getShared('config'),
            $fileType
        ]);

        if ($logger instanceof LoggerInterface) {
            return self::$logger = $logger;
        }

        $logger = new Logger("LoggerService");
        $logger->pushHandler(new ErrorLogHandler());

        return self::$logger = $logger;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function emergency($message, array $context = array())
    {
        return self::getLogger('emergency')->emergency($message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function alert($message, array $context = array())
    {
        return self::getLogger('alert')->alert($message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function critical($message, array $context = array())
    {
        return self::getLogger('critical')->critical($message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function error($message, array $context = array())
    {
        return self::getLogger('error')->error($message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function warning($message, array $context = array())
    {
        return self::getLogger('warning')->warning($message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function notice($message, array $context = array())
    {
        return self::getLogger('notice')->notice($message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function info($message, array $context = array())
    {
        return self::getLogger('info')->info($message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function debug($message, array $context = array())
    {
        return self::getLogger('debug')->debug($message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public static function log($level, $message, array $context = array())
    {
        return self::getLogger($level)->log($level, $message, $context);
    }

}



