<?php
/**
 *
 * @description :活动存储库
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/12 0012 14:24
 *
 */

namespace Dc\Activity\Repositories;

use Dc\Lib\Repositories\Eloquent\Repository;
use Dc\Lib\Repositories\Criteria\Criteria;

class Activity extends Repository
{
    use Base;

    /**
     * Specify Model class name
     *
     * @return string
     */
    protected function model()
    {
        return 'Dc\Activity\Models\ActivityList';
    }

    /**
     * 根据ID获取活动信息
     *
     * @param integer $id
     * @param array|string $columns
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public function findFirstById($id, $columns = ['*'])
    {
        return $this->first('id', $id, $columns);
    }

    /**
     * 获取活动列表
     *
     * @param array|string $columns
     * @param string $orderBy
     * @param string $limit
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public function findList($columns = ['*'], $orderBy = '', $limit = '')
    {
        return $this->find(Criteria::instance(), $columns, $orderBy, $limit);
    }

}