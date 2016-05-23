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

class Config extends \Phalcon\Config
{
    public function __construct()
    {
        $configDir = APP_PATH . '/config/';
        $configDir .= IS_DEV ? 'dev/' : '';

        $this->merge(loadDir($configDir));

        if (IS_DEV !== false && IS_DEV != 'dev') {
            $this->merge(loadDir(APP_PATH . '/config/' . IS_DEV . '/', loadDir($configDir)));
        }

        $this->merge(loadDir(IS_DEV ? APP_PATH . '/apps/' . MODULE_NAME . '/config/dev/' : APP_PATH . '/apps/' . MODULE_NAME . '/config/'));

        if (IS_DEV !== false && IS_DEV != 'dev') {
            $this->merge(loadDir(APP_PATH . '/apps/' . MODULE_NAME . '/config/' . IS_DEV . '/'));
        }

        parent::__construct($this->toArray());
    }
}