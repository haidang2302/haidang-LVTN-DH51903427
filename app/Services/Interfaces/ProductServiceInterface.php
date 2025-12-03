<?php

namespace App\Services\Interfaces;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface
{
    public function paginate($request, $languageId);
    public function combineProductAndPromotion($ids, $product, $flag);
}
