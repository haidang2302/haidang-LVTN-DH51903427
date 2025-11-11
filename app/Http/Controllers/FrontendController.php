<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $systemRepository;
    protected $system;

    public function __construct()
    {
        // $this->setSystem();
    }

    public function setSystem(){
        // $this->system = convert_array(System::all(), 'keyword', 'content');
    }
   

}
