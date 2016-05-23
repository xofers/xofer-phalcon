<?php
/**
 *
 * @description :服务提供
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/19 0019 23:21
 *
 */

namespace Dc\Lib\Support;

use BadMethodCallException;

abstract class ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract public function register();

    /**
     * Dynamically handle missing method calls.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if ($method == 'boot') {
            return;
        }

        throw new BadMethodCallException("Call to undefined method [{$method}]");
    }
}
