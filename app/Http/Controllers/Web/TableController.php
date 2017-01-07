<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class TableController extends Controller
{
    public function query(){
        return view('backend.common.tables');
    }
    
    public function deploy(){
        return view('backend.common.table_deploy');
    }
    
}


