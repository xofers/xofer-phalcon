<?php

/**
 * @description :多彩活动-主控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace Dc\Activity\Controllers;

use Phalcon\Mvc\Controller;
use Dc\Activity\Repositories\Activity as AcList;

class IndexController extends Controller
{

    public function indexAction()
    {
        $id = $this->dispatcher->getParam('id', 'int', '');
        if (empty($id)) {
//            throw new Dispa
        }
//        $activity = AcList::instance()->findFirstById($id);

//        return $this->view->pick('404');
    }
}