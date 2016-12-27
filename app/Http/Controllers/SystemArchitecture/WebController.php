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
    
    
    public function attrs_list(){
        return view('backend.common.attrs');
    }
    
    public function attrs_create(){
        return view('backend.common.attr');
    }
    
}


