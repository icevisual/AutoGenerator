<?php
namespace App\Http\Controllers\SystemArchitecture;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class WebController extends Controller
{

    

    public function demo_list(){
        return view('backend.common.simple');
    }
    
    public function demo_create(){
        return view('backend.common.general');
    }
    
    
    public function components_list(){
        return view('backend.common.simple');
    }
    
    public function components_create(){
        return view('backend.common.general');
    }
    
}


