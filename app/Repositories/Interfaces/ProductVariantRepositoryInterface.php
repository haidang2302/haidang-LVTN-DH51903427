<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ProductVariantServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductVariantRepositoryInterface
{
    public function findVariant($attributeId, $productId, $language);
    public function findByCondition($condition = [], $flag = false, $relation = [], array $orderBy = ['id', 'desc'], array $param = [], array $withCount = []);
}
