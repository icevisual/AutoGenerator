<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class SystemController extends Controller
{

    public function error_404(){
        return view('errors.404');
    }

    public function demo_list(){
        return view('backend.common.simple');
    }
    
    public function demo_create(){
        return view('backend.common.general');
    }
    
}


