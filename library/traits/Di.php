<?php
/**
 *
 * @description :服务容器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/11 0011 16:28
 *
 */
namespace Dc\Lib\Traits;

use Phalcon\DiInterface;

trait Di
{
    protected $_di;

    public function setDI(DiInterface $di)
    {
        $this->_di = $di;
    }

    public function getDI()
    {
        return $this->_di;
    }
}