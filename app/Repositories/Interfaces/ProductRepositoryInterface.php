<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductRepositoryInterface
{
    public function findById($id, $columns = ['*'], $relations = []);
    public function findByCondition($condition = [], $flag = false, $relation = [], array $orderBy = ['id', 'desc'], array $param = [], array $withCount = []);
}
