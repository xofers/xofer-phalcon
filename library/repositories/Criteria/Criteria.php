<?php
namespace Dc\Lib\Repositories\Criteria;

use Phalcon\Mvc\Model;
use Dc\Lib\Traits\Singleton;
use Phalcon\Mvc\Model\Criteria as PhalconCriteria;
use Dc\Lib\Repositories\Contracts\CriteriaInterface;

/**
 * Class Repository
 * @package Dc\Lib\Repositories\Criteria
 */
class Criteria extends PhalconCriteria implements CriteriaInterface
{
    use Singleton;
}