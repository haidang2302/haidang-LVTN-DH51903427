<?php

namespace App\Http\Controllers\Backend\Crm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Services\Interfaces\ConstructServiceInterface  as ConstructService;
use App\Repositories\Interfaces\AgencyRepositoryInterface  as AgencyRepository;
// ...existing use statements...
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Repositories\Interfaces\CustomerCatalogueRepositoryInterface as CustomerCatalogueRepository;
use App\Repositories\Interfaces\SourceRepositoryInterface as SourceRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface  as ProvinceRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Http\Requests\Construct\StoreConstructRequest;
use App\Http\Requests\Construct\UpdateConstructRequest;
use App\Repositories\AgencyRepository as RepositoriesAgencyRepository;


class ConstructionController extends Controller
{
    // protected $constructService;
    // ...existing properties...
    protected $customerRepository;
    protected $customerCatalogueRepository;
    protected $sourceRepository;
    protected $provinceRepository;
    protected $agencyRepository;
    protected $languageRepository;
    protected $language;
    protected $model = 'Construction';
    

    public function __construct(
        LanguageRepository $languageRepository,
    // ConstructService $constructService,
    // ...existing constructor params...
        CustomerRepository $customerRepository,
        CustomerCatalogueRepository $customerCatalogueRepository,
        SourceRepository $sourceRepository,
        ProvinceRepository $provinceRepository,
        AgencyRepository $agencyRepository
    ){
    // $this->constructService = $constructService;
    // ...existing constructor body...
        $this->customerRepository = $customerRepository;
        $this->customerCatalogueRepository = $customerCatalogueRepository;
        $this->sourceRepository = $sourceRepository;
        $this->provinceRepository = $provinceRepository;
        $this->agencyRepository = $agencyRepository;
    }

    public function index(Request $request){
    $constructs = null; // Đã xóa service, cần xử lý lại logic nếu cần

        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => $this->model
        ];
        $config['seo'] = __('messages.construct');
        $template = 'backend.construct.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'constructs',
        ));
    }

    public function create(Request $request){
       
        $agencys = convertCombineArray($this->agencyRepository->all());
        $customers = convertCombineArray($this->customerRepository->all(), 'name');

        $provinces = $this->provinceRepository->all();
        $config = $this->configData();
        $config['seo'] = __('messages.construct');
        $config['method'] = 'create';
        $config['model'] = $this->model;
        $template = 'backend.construct.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'agencys',
            'customers',
        ));
    }

    public function store(StoreConstructRequest $request){
        // if($this->constructService->create($request)){
        //     return redirect()->route('construction.index')->with('success','Thêm mới bản ghi thành công');
        // }
        // return redirect()->route('construction.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
        return redirect()->route('construction.index')->with('error','Chức năng đã bị xóa');
    }

    public function edit($id, Request $request){

        $agencys = convertCombineArray($this->agencyRepository->all());
        $customers = convertCombineArray($this->customerRepository->all(), 'name');
        $provinces = $this->provinceRepository->all();

        $construct = null; // Đã xóa repository, cần xử lý lại logic nếu cần


    // $productConstruction = $this->constructService->productConstruction($construct->products);
        $queryUrl = $request->getQueryString();
        $config = $this->configData();
        $config['seo'] = __('messages.construct');
        $config['method'] = 'edit';
        $config['model'] = $this->model;
        $template = 'backend.construct.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'construct',
            'customers',
            'agencys',
            'provinces',
            'productConstruction',
            'queryUrl'
        ));
    }

  

    public function update($id, UpdateConstructRequest $request){
        $queryUrl = base64_decode($request->getQueryString());
        // if($this->constructService->update($id, $request)){
        //     return redirect()->route('construction.index', $queryUrl)->with('success','Cập nhật bản ghi thành công');
        // }
        // return redirect()->route('construction.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
        return redirect()->route('construction.index')->with('error','Chức năng đã bị xóa');
    }


    public function delete($id){
        $config['seo'] = __('messages.construct');
    $construct = null; // Đã xóa repository, cần xử lý lại logic nếu cần
        $template = 'backend.construct.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'construct',
            'config',
        ));
    }

    public function destroy($id){
        // if($this->constructService->destroy($id)){
        //     return redirect()->route('construction.index')->with('success','Xóa bản ghi thành công');
        // }
        // return redirect()->route('construction.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
        return redirect()->route('construction.index')->with('error','Chức năng đã bị xóa');
    }

    public function warranty(Request $request){
    $warranty = null; // Đã xóa service, cần xử lý lại logic nếu cần
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
        ];
        $config['seo'] = __('messages.warranty');
        $template = 'backend.construct.warranty';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'warranty',
        ));
    }


    private function configData(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/library/construct.js',
            ]
        ];
    }

}
