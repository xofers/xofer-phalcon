<?php

/**
 * @description :多彩活动-主控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace App\Activity\Controllers;

use App\Activity\Repositories\AcList;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function showAction(AcList $acList)
    {
    }
}