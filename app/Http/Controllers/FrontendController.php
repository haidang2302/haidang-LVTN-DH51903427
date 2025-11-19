<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Language;
use App\Models\System;

class FrontendController extends Controller
{
    protected $language;
   
    protected $system;

    public function __construct(
        // SystemRepository $systemRepository
    ){

        $this->setLanguage();
        

    }

    public function setLanguage(){
        $locale = app()->getLocale(); // vn en cn
        $language = Language::where('canonical', $locale)->first();
        $this->language = $language->id;
    }

   
   

}
