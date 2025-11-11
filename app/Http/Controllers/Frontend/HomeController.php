<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

use App\Enums\SlideEnum;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;


class HomeController extends FrontendController
{
    protected $language;
    
    protected $system;

    public function __construct()
    {
        parent::__construct(); 
    }

    


    public function index(){


        $config = $this->config();
        $widgets = []; 
        $slides = []; // Temporary disabled
       
        $system = [
            'homepage_company' => config('app.name', ''),
            'homepage_brand' => config('app.name', ''),
            'homepage_logo' => '',
            'homepage_favicon' => '',
            'seo_meta_title' => config('app.name', ''),
            'contact_hotline' => '',
            'contact_email' => '',
        ]; // Temporary disabled
        $seo = [
            'meta_title' => config('app.name'),
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => config('app.url'),
        ];
        return view('frontend.homepage.home.index', compact(
            'config',
            'slides',
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
