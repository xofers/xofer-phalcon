<?php

/**
 *
 * @description :数据存取库服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/25 0025 11:00
 *
 */

namespace Dc\Modules\Services;
/**
 * @property \App\Activity\Repositories\AcList $AcList
 */
class Repository
{

    protected $_namespace;

    protected $_repositories = [];

    public function __construct($namespace = '')
    {
        $this->_namespace = $namespace;
    }

    public function get($repository)
    {
        if (!class_exists($this->_namespace . '\\' . $repository)) {
            trigger_error("{$this->_namespace}" . '\\' . "{$repository} class is not exists");
            return null;
        }

        if (array_key_exists($repository, $this->_repositories)) {
            return $this->_repositories[$repository];
        }

        if (!method_exists($this->_namespace . '\\' . $repository, 'instance')) {
            trigger_error("{$this->_namespace}" . '\\' . "{$repository} class is not exists ‘instance‘ method");
            return null;
        }
        $obj = $this->_namespace . '\\' . $repository;

        return $this->_repositories[$repository] = $obj::instance();
    }

    public function __get($repository)
    {
        return $this->get($repository);
    }
}