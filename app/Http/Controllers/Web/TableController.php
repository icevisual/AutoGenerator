<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class TableController extends Controller
{
    public function query(){
        $json = '{"code":1,"msg":"OK","data":{"table":{"type":"table","attrs":{"caption":"\u6570\u636e\u8868\u5217\u8868","RESTful":true,"ajax":true,"uris":{"query":{"url":"\/api\/tables","param":[],"method":"GET"},"update":{"url":"\/table\/{id}","param":["id"],"method":"GET"},"delete":{"url":"\/api\/table\/{id}","param":["id"],"method":"DELETE"}},"rownum":true,"hidden":{"id":true},"operation":true,"operations":{"update":true,"delete":true},"header":{"TABLE_NAME":{"name":"\u8868\u540d","width":"200px"},"TABLE_COMMENT":"\u63cf\u8ff0"}},"data":{"total":5,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":2,"TABLE_NAME":"attrs","TABLE_COMMENT":"\u7ec4\u4ef6\u5c5e\u6027\u8868","CONNECTION":"auto"},{"id":3,"TABLE_NAME":"component","TABLE_COMMENT":"\u7ec4\u4ef6\u8868","CONNECTION":"auto"},{"id":4,"TABLE_NAME":"component_attrs","TABLE_COMMENT":"\u7ec4\u4ef6\u5c5e\u6027\u8868","CONNECTION":"auto"},{"id":5,"TABLE_NAME":"form","TABLE_COMMENT":"\u8868\u5355\u8868","CONNECTION":"auto"},{"id":6,"TABLE_NAME":"form_component","TABLE_COMMENT":"\u7ec4\u4ef6\u5b9e\u4f8b\u8868","CONNECTION":"auto"}]}}}}';
        return view('backend.common.tables',['formConfig' => $json]);
    }
    
    public function deploy(){
        return view('backend.common.table_deploy');
    }
    
    public function create(){
        return view('backend.common.table');
    }
    
    
}


