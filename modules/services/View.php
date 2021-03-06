<?php

/**
 *
 * @description :视图服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;

use Dc\Lib\Traits\ServiceEvents;

class View extends \Phalcon\Mvc\View
{
    use ServiceEvents;

    /**
     * @var string
     */
    public $attachName = 'view';
}