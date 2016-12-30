<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class ComponentController extends Controller
{
    public function query(){
        return view('backend.common.components');
    }
    
    public function create(){
        return view('backend.common.component');
    }
    
}


