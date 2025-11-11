<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        // Tạm thời để trống
    }

    public function findVariant($attributeId, $productId, $language)
    {
        return null;
    }

    public function findByCondition($conditions = [], $flag = false, $relation = [])
    {
        return null;
    }
}
