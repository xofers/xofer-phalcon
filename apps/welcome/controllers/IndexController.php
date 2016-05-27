<?php

/**
 * @description :默认控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace App\Welcome\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class IndexController extends Controller {

    public function notFoundAction(){
        $this->view->pick('404');
    }
}
