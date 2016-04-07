<?php

/**
 * @description :微信远程通信控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace Dc\Welcome\Controllers;

use Phalcon\Mvc\Controller;
use EasyWeChat\Foundation\Application;

class ServerController extends Controller {

    public function indexAction() {

        $wxApp = new Application($this->config->toArray());

        $server = $wxApp->server;
        $server->setMessageHandler(function ($message) {
            return "您好！欢迎关注我!当前事件为".$message->MsgType;
        });

        $server->serve()->send();
    }
}
