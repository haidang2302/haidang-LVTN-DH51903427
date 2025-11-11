<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService
{
    protected $controllerName;

    public function formatJson($model, $module){
        $temp = [];
        if(count($model)){
            foreach($model as $key => $val){
                $temp[] = [
                    'id' => $val->id,
                    'name' => $val->{$module.'s'}->first()->pivot->name
                ];
            }
        }
        return $temp;
    }

    public function formatRouterPayload($model, $request, $controllerName){
        $canonical = make_canonical($request->input('canonical'));
        $moduleId = $model->id;
        $payload = [
            'canonical' => $canonical,
            'module_id' => $moduleId,
            'controllers' => 'App\Http\Controllers\Frontend\\'. $controllerName . 'Controller',
        ];
        return $payload;
    }

    public function nestedset(){
        // $this->categoryService->nestedset();
    }

    public function formatAlbum($request){
        return ($request->input('album') && !empty($request->input('album'))) ? json_encode($request->input('album')) : '';
    }

    public function createCatalogue($request){
        DB::beginTransaction();
        try{
            $payload = $request->only($this->payload());
            $payload['album'] = $this->formatAlbum($request);
            $payload['user_id'] = Auth::id();
            $catalogue = $this->catalogueRepository->create($payload);
            if($catalogue->id > 0){
                $this->updateLanguageForCatalogue($catalogue, $request);
                $this->uploadCatalogue($catalogue, $request);
                $this->createRouter($catalogue, $request, $this->controllerName);
            }
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function payload(){
        return [
            'follow',
            'publish',
            'image',
            'level',
            'catalogue_id',
            'parent_id',
            'name',
            'canonical',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
        ];
    }

    public function payloadLanguage(){
        return  [
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
