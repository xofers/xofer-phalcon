<?php
namespace Dc\Lib\Repositories\Contracts;

/**
 * Interface RepositoryInterface
 * @package Dc\Lib\Repositories\Contracts
 */
interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function query();
}
