<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AgencyRepositoryInterface  as AgencyRepository;
use App\Services\Interfaces\AgencyServiceInterface  as AgencyService;
// use App\Services\Interfaces\ConstructServiceInterface  as ConstructService;
use App\Http\Requests\Agency\StoreAgencyRequest;


class ConstructController extends Controller
{
    protected $agencyRepository;
    protected $agencyService;
    // ...existing properties...
    // protected $constructService;
    
    public function __construct(
        AgencyService $agencyService,
        AgencyRepository $agencyRepository,
    // ...existing constructor params...
    // ConstructService $constructService,
    ){
        $this->agencyRepository = $agencyRepository;
        $this->agencyService = $agencyService;
    // $this->constructService = $constructService;
    // ...existing constructor body...
    }

    public function createAgency(StoreAgencyRequest $request){
        $agency = $this->agencyService->create($request); 
        if($agency !== FALSE){
            return response()->json([
                'code' => 0,
                'message' => 'Tạo đại lý thành công!',
                'data' => $agency,
            ]);
        }
        return response()->json([
            'message' => 'Có vấn đề xảy ra, hãy thử lại',
            'code' => 1
        ]);
    }
}
