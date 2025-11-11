<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface  as DistrictRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface  as ProvinceRepository;

class LocationController extends Controller
{

    protected $districtRepository;
    protected $provinceRepository;

    public function __construct(
        DistrictRepository $districtRepository,
        ProvinceRepository $provinceRepository
    ){
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function getLocation(Request $request){
        $get = $request->input();

        $html = '';
        if($get['target'] == 'districts'){
            $districts = $this->districtRepository->findDistrictByProvinceId($get['data']['location_id']);
            $html = $this->renderHtml($districts);
        }else if($get['target'] == 'wards'){
            $district = \App\Models\District::with('wards')->where('code', $get['data']['location_id'])->first();
            $wards = $district ? $district->wards : [];
            $html = $this->renderHtml($wards, '[Chọn Phường/Xã]');
        }
        $response = [
            'html' => $html
        ];
        return response()->json($response); 
    }

    public function renderHtml($districts, $root = '[Chọn Quận/Huyện]'){
        $html = '<option value="0">'.$root.'</option>';
        foreach($districts as $district){
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }

   
}
