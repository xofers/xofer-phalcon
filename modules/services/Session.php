<?php

/**
 *
 * @description :PhpStorm
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;

use Predis\Client;
use Predis\Session\Handler;

class Session extends Client
{
    public function __construct(Config $config, $options)
    {
        $options['prefix'] .= MODULE_NAME . '_';

        parent::__construct(array_values($config->redis->toArray()), $options);

        $handler = new Handler($this, ['gc_maxlifetime' => 86400]);

        $handler->register();

    }

}