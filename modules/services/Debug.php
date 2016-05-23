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


use PhpConsole\Handler;

class Debug extends Handler
{
    public function __construct(Config $config)
    {
        parent::__construct();

        if (empty($config->debug)) {
            return;
        }

        $this->connector->setPassword($config->debug->password);

        $this->connector->startEvalRequestsListener();

        if (IS_DEV && $config->debug->start) {
            $this->start();
        }
    }
}