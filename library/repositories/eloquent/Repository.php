<?php
namespace Dc\Lib\Repositories\Eloquent;

use Phalcon\Mvc\Model;
use Dc\Lib\Repositories\Criteria\Criteria;
use Dc\Lib\Repositories\Contracts\RepositoryInterface;
use Dc\Lib\Repositories\Exceptions\RepositoryException;

/**
 * Class Repository
 * @package Dc\Lib\Repositories\Eloquent
 */
abstract class Repository implements RepositoryInterface
{
    protected $model;

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract protected function model();

    public function __construct()
    {
        $class = $this->model();
        if (!method_exists($class, 'instance')) {
            throw new RepositoryException("{$class} must has method getInstance");
        }
        $model = $class::instance();

        if (!$model instanceof Model) {
            throw new RepositoryException("{$class} is not a Phalcon\\Mvc\\Model");
        }
        $this->model = $model;
    }

    public function query()
    {
        return $this->model->query();
    }

    /**
     *
     *
     * @return Model\Query\BuilderInterface
     */
    public function builder()
    {
        return $this->model->getModelsManager()->createBuilder();
    }

    /**
     * 获取一条数据
     *
     * @param $field
     * @param $val
     * @param array $columns
     * @param string $operator
     * @return Model\ResultsetInterface
     */
    public function first($field, $val, $columns = ["*"], $operator = '=')
    {
        return $this->query()->columns($columns)->where("{$field} {$operator} {$val}")->limit(1)->execute();
    }

    /**
     * 获取多条数据
     *
     * @param Criteria $criteria
     * @param string|array $columns
     * @param string $orderBy
     * @param array $limits
     * @return Model\ResultsetInterface
     */
    public function find(Criteria $criteria, $columns = '', $limits = [], $orderBy = '')
    {
        empty($columns) ?: $criteria->columns($columns);
        empty($orderBy) ?: $criteria->orderBy($orderBy);
        if(!empty($limits)){
            list($limit, $offset) = count($limits) == 1 ? [$limits[0], null] : $limits;
            $criteria->limit($limit, $offset);
        }
        return $criteria->setModelName($this->model())->execute();
    }
}
