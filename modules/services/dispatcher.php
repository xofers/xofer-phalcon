<?php

/**
 *
 * @description :基础配置服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;

use Dc\Modules\Events;

class Dispatcher extends \Phalcon\Dispatcher
{
    public function __construct()
    {
        $this->setEventsManager(new Events\Dispatcher());
    }
}