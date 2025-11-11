<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RouterRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class RouterRepository
 * @package App\Repositories
 */
class RouterRepository extends BaseRepository implements RouterRepositoryInterface
{
    protected $model;

    public function __construct(
        // \App\Models\Router $model
    ){
        // $this->model = $model;
    }

    // Router functionality has been removed
}
