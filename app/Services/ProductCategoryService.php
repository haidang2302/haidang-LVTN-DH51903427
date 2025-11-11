<?php

namespace App\Services;

use App\Services\Interfaces\ProductCatalogueServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface as AttributeCatalogueRepository;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;

/**
 * Class ProductCatalogueService
 * @package App\Services
 */
class ProductCategoryService extends BaseService implements ProductCategoryServiceInterface
{
    protected $productCategoryRepository;
    public function destroy($id){
        DB::beginTransaction();
        try{
            $productCategory = $this->productCategoryRepository->delete($id);
            $this->routerRepository->forceDeleteByCondition([
                ['module_id', '=', $id],
                ['controllers', '=', 'App\\Http\\Controllers\\Frontend\\ProductCategoryController'],
            ]);
            $this->nestedset = new Nestedsetbie([
                'table' => 'product_categories',
                'foreignkey' => 'product_category_id',
            ]);
            $this->nestedset();
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    private function createCatalogue($request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $payload['user_id'] = Auth::id();
        $productCatalogue = $this->productCatalogueRepository->create($payload);
        return $productCatalogue;
    }

    private function updateCatalogue($productCatalogue, $request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $flag = $this->productCatalogueRepository->update($productCatalogue->id, $payload);
        return $flag;
    }




    public function setAttribute($product){
        $attribute = $product->attribute;
        $result = null;
        if(!is_null($attribute)){
            $productCatalogueId = (int)$product->product_catalogue_id;
            $productCatalogue = $this->productCatalogueRepository->findById($productCatalogueId);
            if(!is_array($productCatalogue->attribute)){
                $payload['attribute'] = $attribute;
            }else{
                $mergeArray = $productCatalogue->attribute;
                foreach($attribute as $key => $val){
                    if(!isset($mergeArray[$key])){
                        $mergeArray[$key] = $val;
                    }else{
                        $mergeArray[$key] = array_values(array_unique(array_merge($mergeArray[$key], $val)));
                    }
                }
                $flatAttributeArray = array_merge(...$mergeArray);
                $attributeList = $this->attributeRepository->findAttributeProductVariant($flatAttributeArray, $productCatalogue->id);
    
                $payload['attribute'] = array_map(function($newArray) use ($attributeList){
                        return  array_intersect($newArray, $attributeList->all());
    
                }, $mergeArray);
    
            }
            $result = $this->productCatalogueRepository->update($productCatalogueId, $payload);
        }
        return $result;
    }

  

    public function getFilterList(array $attribute = []){
        $attributeCatalougeId = array_keys($attribute);
        $attributeId = array_unique(array_merge(...$attribute));

        $attributeCatalogues = $this->attributeCatalogueRepository->findByCondition(
            [
                config('apps.general.defaultPublish')
            ],
            true,
            [],
            ['id', 'asc'],
            [
                'whereIn' => $attributeCatalougeId,
                'whereInField' => 'id'
            ]
        );

        $attributes = $this->attributeRepository->findByCondition(
            [
                config('apps.general.defaultPublish')
            ],
            true,
            [],
            ['id', 'asc'],
            [
                'whereIn' => $attributeId,
                'whereInField' => 'id'
            ]
        );

        foreach($attributeCatalogues as $key => $val){
            $attributeItem = [];
            foreach($attributes as $index => $item){
                if($item->attribute_catalogue_id === $val->id){
                    $attributeItem[] = $item;
                }
            }
            $val->setAttribute('attributes', $attributeItem);
        }
        return $attributeCatalogues;
    }
    
    

    private function paginateSelect(){
        return [
            'product_catalogues.id', 
            'product_catalogues.publish',
            'product_catalogues.image',
            'product_catalogues.level',
            'product_catalogues.order',
            'tb2.name', 
            'tb2.canonical',
        ];
    }

    private function payload(){
        return [
            'parent_id',
            'follow',
            'publish',
            'image',
            'album',
            'icon',
        ];
    }



}
