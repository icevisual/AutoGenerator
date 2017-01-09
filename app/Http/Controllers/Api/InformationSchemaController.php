<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;
use App\Models\Form\Component;
use App\Models\Form\ComponentAttrs;
use App\Models\InformationSchema\Tables;
use App\Models\Common\Tables AS OpTables;
use App\Models\InformationSchema\Columns;

class InformationSchemaController extends Controller
{

    public function queryTables(){
        $page = \Input::get('p', 1); // 页数
        $pageSize = \Input::get('n', 10000); // 每页条数
        $data = Tables::queryTables([], $page, $pageSize);
        return $this->__json($data);
    }
    
    public function tableDeploy($id){
        
        $tname = OpTables::getTableName($id);
        $detail = Columns::queryTableColumns($tname);
        $file = 'jsonf/table-deploy.js';
        if (file_exists(public_path($file))) {
        
            $json = file_get_contents(public_path($file));
            $json = json_decode($json,1);
            array_set($json, 'table.attrs.caption', '表 ['.$tname.'] 字段');
//             array_set($json, 'component_form.attrs.action.method', 'PUT');
//             array_set($json, 'component_form.fields.id', [
//                 'name' => ' ID',
//                 'type' => 'input',
//                 'hidden' => true,
//                 'value' => $detail['component']['id']
//             ]);
//             array_set($json, 'component_form.fields.component_name.value',$detail['component']['component_name'] );
//             array_set($json, 'component_form.fields.component_desc.value',$detail['component']['component_desc'] );
            array_set($json, 'table.data.list',$detail );
            return $this->__json($json);
        }
        return $this->__json(\ErrorCode::SYSTEM_ERROR);
    }
    
    
    
}


