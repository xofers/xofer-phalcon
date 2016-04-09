<?php

/**
 * @description :微信公众平台-主控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace Dc\Wechat\Controllers;

use Dc\Lib\Log,
    Phalcon\Mvc\Controller;

class IndexController extends Controller {

    public function indexAction() {
        Log::alert("aaa");
        Log::debug("aaaa",$this->config->wechat->toArray());
    }
}
