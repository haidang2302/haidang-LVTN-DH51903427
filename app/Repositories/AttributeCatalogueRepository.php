<?php

namespace App\Repositories;

use App\Models\AttributeCatalogue;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class AttributeCatalogueRepository extends BaseRepository implements AttributeCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        AttributeCatalogue $model
    ){
        $this->model = $model;
    }

    

    public function getAttributeCatalogueById(int $id = 0, $language_id = 0){
        return $this->model->select([
                'attribute_catalogues.*'
            ]
        )
        ->find($id);
    }

    public function getAll(?int $languageId = 0){
       
        return $this->model->get();
    }

    public function paginate($perPage = null){
        
        return $this->model
            ->whereNotNull('name')
            ->orderBy('lft', 'ASC')
            ->paginate($perPage ?? 20);
    }

    public function getAttributeCatalogueWhereIn($whereIn, $whereInField = 'id', $language_id){
        return $this->model->select([
            'attribute_catalogues.id',
            'tb2.name',
        ])
        ->join('attribute_catalogue_language as tb2', 'tb2.attribute_catalogue_id', '=','attribute_catalogues.id')
        ->where('tb2.language_id', '=', $language_id)
        ->where([config('apps.general.defaultPublish')])
        ->whereIn($whereInField, $whereIn)
        ->get();
    }  

}
