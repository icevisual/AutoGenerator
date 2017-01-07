<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;
use App\Models\Form\Component;
use App\Models\Form\ComponentAttrs;
use App\Models\InformationSchema\Tables;

class InformationSchemaController extends Controller
{

    public function queryTables(){
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10000); // 每页条数
        $data = Tables::queryTables([], $page, $pageSize);
        return $this->__json($data);
    }
    
    
}


