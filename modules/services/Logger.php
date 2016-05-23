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

use Monolog\Logger as MonologLogger;
use Monolog\Handler;
use PhpConsole;

class Logger extends MonologLogger
{
    public function __construct(Config $config = null, $fileType = null)
    {
        parent::__construct(MODULE_NAME);

        $config->log->file = str_replace('TYPE', strtoupper($fileType), $config->log->file);

        $this->pushHandler(new Handler\StreamHandler($config->log->file, $config->log->level));

        if (IS_DEV && !empty($config->debug) && $config->debug->start) {
            $this->pushHandler(new Handler\PHPConsoleHandler());
        }
    }
}