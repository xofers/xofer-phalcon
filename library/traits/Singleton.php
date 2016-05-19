<?php
/**
 *
 * @description :单例
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/11 0011 16:28
 *
 */
namespace Dc\Lib\Traits;

trait Singleton
{
    protected static $instance;

    final public static function instance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    final private function __wakeup()
    {
    }

    final private function __clone()
    {
    }
}