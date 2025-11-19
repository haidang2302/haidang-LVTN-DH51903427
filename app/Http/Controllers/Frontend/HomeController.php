<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
// ...existing code...
use App\Services\Interfaces\WidgetServiceInterface  as WidgetService;
// ...existing code...
use App\Enums\SlideEnum;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;


class HomeController extends FrontendController
{
    protected $language;
    // ...existing code...
    protected $widgetService;
    // ...existing code...
    protected $system;

    public function __construct(
        // ...existing code...
        WidgetService $widgetService,
        // ...existing code...
    ){
        // ...existing code...
        $this->widgetService = $widgetService;
        // ...existing code...

    }

    


    public function index(){


        $config = $this->config();
        $languageId = is_int($this->language) ? $this->language : 1;
        $widgets = $this->widgetService->getWidget([
            // ['keyword' => 'category', 'countObject' => true],
            // ['keyword' => 'homepage-customer', 'children' => true],
            // ['keyword' => 'category-highlight'],
            ['keyword' => 'product', 'children' => true, 'promotion' => TRUE, 'object' => TRUE],
            ['keyword' => 'flash-sale','promotion' => true],
            // ['keyword' => 'home-intro'],
            // ['keyword' => 'home-project', 'object' => true],
            // ['keyword' => 'home-video', 'object' => true],
            // ['keyword' => 'home-whyus', 'object' => true],
          
        ], $languageId);

        // dd($widgets);
    // ...existing code...
        $system = is_array($this->system) ? $this->system : [];
        $seo = [
            'meta_title' => $system['seo_meta_title'] ?? '',
            'meta_keyword' => $system['seo_meta_keyword'] ?? '',
            'meta_description' => $system['seo_meta_description'] ?? '',
            'meta_image' => $system['seo_meta_images'] ?? '',
            'canonical' => config('app.url'),
        ];
        return view('frontend.homepage.home.index', compact(
            'config',
            
            'widgets',
            'seo',
            'system',
        ));
    }

    public function ckfinder(){
        return view('frontend.homepage.home.ckfinder');
    }

  

    private function config(){
        return [
            'language' => $this->language,
            'css' => [
                'frontend/resources/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css',
                'frontend/resources/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css'
            ],
            'js' => [
                'frontend/resources/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js',
                'https://getuikit.com/v2/src/js/components/sticky.js'
            ]
        ];
    }

}
