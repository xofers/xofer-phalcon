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

use Doctrine\Common\Cache\PredisCache;
use Predis\Client;

class Cache extends PredisCache
{
    public function __construct(Config $config, $options)
    {
        $options['prefix'] .= MODULE_NAME . '_';

        parent::__construct(new Client(array_values($config->redis->toArray()), $options));

    }
}