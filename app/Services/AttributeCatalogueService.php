<?php

namespace App\Services;

use App\Services\Interfaces\AttributeCatalogueServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface as AttributeCatalogueRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;

/**
 * Class AttributeCatalogueService
 * @package App\Services
 */
class AttributeCatalogueService extends BaseService implements AttributeCatalogueServiceInterface
{


    protected $attributeCatalogueRepository;
    protected $routerRepository;
    protected $nestedset;
    protected $language;
    protected $controllerName = 'AttributeCatalogueController';
    

    public function __construct(
        AttributeCatalogueRepository $attributeCatalogueRepository,
        RouterRepository $routerRepository,
    ){
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
        $this->routerRepository = $routerRepository;
    }

    public function paginate($request, $languageId){
        $perPage = $request->integer('perpage') ?: 20;
        
        // Sử dụng method paginate() mới từ repository (không JOIN language)
        $attributeCatalogues = $this->attributeCatalogueRepository->paginate($perPage);

        return $attributeCatalogues;
    }

    public function create($request, $languageId){
        DB::beginTransaction();
        try{
            $attributeCatalogue = $this->createCatalogue($request);
            if($attributeCatalogue->id > 0){
               
                $this->nestedset = new Nestedsetbie([
                    'table' => 'attribute_catalogues',
                    'foreignkey' => 'attribute_catalogue_id',
                    'language_id' =>  $languageId ,
                ]);
                $this->nestedset();
            }
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function update($id, $request, $languageId){
        DB::beginTransaction();
        try{
            $attributeCatalogue = $this->attributeCatalogueRepository->findById($id);
            $flag = $this->updateCatalogue($attributeCatalogue, $request);
            if($flag == TRUE){
                
                $this->nestedset = new Nestedsetbie([
                    'table' => 'attribute_catalogues',
                    'foreignkey' => 'attribute_catalogue_id',
                    'language_id' =>  $languageId ,
                ]);
                $this->nestedset();
            }
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function destroy($id, $languageId){
        DB::beginTransaction();
        try{
            $attributeCatalogue = $this->attributeCatalogueRepository->delete($id);
            $this->nestedset = new Nestedsetbie([
                'table' => 'attribute_catalogues',
                'foreignkey' => 'attribute_catalogue_id',
                'language_id' =>  $languageId ,
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

    public function createCatalogue($request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $payload['user_id'] = Auth::id();
        
        // Tính lft/rgt tạm thời cho nested set
        $maxRgt = \App\Models\AttributeCatalogue::max('rgt') ?? 0;
        $payload['lft'] = $maxRgt + 1;
        $payload['rgt'] = $payload['lft'] + 1;
        $payload['level'] = 1;
        
        $attributeCatalogue = $this->attributeCatalogueRepository->create($payload);
        return $attributeCatalogue;
    }

    private function updateCatalogue($attributeCatalogue, $request){
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($request);
        $flag = $this->attributeCatalogueRepository->update($attributeCatalogue->id, $payload);
        return $flag;
    }


    private function paginateSelect(){
        return [
            'attribute_catalogues.id', 
            'attribute_catalogues.publish',
            'attribute_catalogues.image',
            'attribute_catalogues.level',
            'attribute_catalogues.order',
            'tb2.name', 
            'tb2.canonical',
        ];
    }

    public function payload(){
        return [
            'parent_id',
            'follow',
            'publish',
            'image',
            'album',
            'name',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'canonical'
        ];
    }
    
    public function payloadLanguage(){
        return [
            'name',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'canonical'
        ];
    }


}
