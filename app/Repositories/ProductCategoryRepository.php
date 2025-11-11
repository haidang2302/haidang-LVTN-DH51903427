<?php

namespace App\Repositories;

use App\Models\ProductCatalogue;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{
    protected $model;

    public function __construct(
        ProductCategory $model
    ){
        $this->model = $model;
    }


    public function getProductCategoryById(int $id = 0){
        return $this->model->select([
                'product_categories.id',
                'product_categories.parent_id',
                'product_categories.lft',
                'product_categories.rgt',
                'product_categories.image',
                'product_categories.icon',
                'product_categories.album',
                'product_categories.publish',
                'product_categories.follow',
                'product_categories.attribute',
            ]
        )
        ->find($id);
    }

    public function getChildren($productCatalogue){
        return $this->model->select([
                'product_catalogues.id',
                'product_catalogues.parent_id',
                'product_catalogues.lft',
                'product_catalogues.rgt',
                'product_catalogues.image',
                'product_catalogues.icon',
                'product_catalogues.album',
                'product_catalogues.publish',
                'product_catalogues.follow',
                'product_catalogues.attribute',
            ]
        )
        ->where('lft' , '>=', $productCatalogue->lft)
        ->where('rgt', '<=', $productCatalogue->rgt)
        ->get();
    }

    public function getProductCategoryByPublish($publish) {
        return $this->model->where('publish', $publish)->get();
    }

}
