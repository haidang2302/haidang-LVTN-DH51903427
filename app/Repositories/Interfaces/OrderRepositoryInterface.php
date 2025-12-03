<?php

namespace App\Repositories\Interfaces;

/**
 * Interface OrderRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface OrderRepositoryInterface
{
    public function orderByCustomer($customer_id = 0, $condition = []);
    public function getOrderById($id);
    public function findByCondition($condition = [], $flag = false, $relation = [], array $orderBy = ['id', 'desc'], array $param = [], array $withCount = []);
    public function create(array $payload = []);
   
}