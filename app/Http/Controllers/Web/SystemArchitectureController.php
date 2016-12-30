<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class SystemArchitectureController extends Controller
{

    

    public function demo_list(){
        return view('backend.common.simple');
    }
    
    public function demo_create(){
        return view('backend.common.general');
    }
    
}


