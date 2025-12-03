<?php

namespace App\Repositories\Interfaces;

/**
 * Interface PromotionServiceInterface
 * @package App\Services\Interfaces
 */
interface PromotionRepositoryInterface
{
    public function findPromotionByVariantUuid($uuid);
    public function getPromotionByCartTotal();
}

