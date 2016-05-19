<?php
namespace Dc\Lib\Repositories\Eloquent;

use Dc\Lib\Traits\Singleton;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Criteria as PhalconCriteria;
use Dc\Lib\Repositories\Contracts\CriteriaInterface;

/**
 * Class Repository
 * @package Dc\Lib\Repositories\Eloquent
 */
class Criteria extends PhalconCriteria implements CriteriaInterface
{
    use Singleton;
}