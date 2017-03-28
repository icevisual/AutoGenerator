<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;
use App\Models\Form\Attrs;

class ComponentAttrsController extends Controller
{

    public function query()
    {
        $list = $this->invokeRoute('api_attrs_list');
        $listJson = json_encode($list['data']);
        
        $data =<<<EOL
{
    "attrs_table": {
        "type": "table",
        "attrs": {
            "caption": "属性表",
            "RESTful": true,
            "ajax": true,
            "uris": {
                "query": {
                    "url": "/api/attrs",
                    "param": [],
                    "method": "GET"
                },
                "update": {
                    "url": "/attr/{id}",
                    "param": [
                        "id"
                    ],
                    "method": "GET"
                },
                "delete": {
                    "url": "/api/attr/{id}",
                    "param": [
                        "id"
                    ],
                    "method": "DELETE"
                }
            },
            "rownum": true,
            "hidden": {
                "id": true
            },
            "operation": true,
            "operations": {
                "update": true,
                "delete": true
            },
            "header": {
                "attr_name": {
                    "name": "属性名",
                    "width": "200px"
                },
                "attr_name_cn": "显示名称",
                "attr_type": "数据类型",
                "form_type": "渲染类型"
            }
        },
        "data": $listJson
    }
}        
EOL;
        
        return $this->renderList($data);
    }

    public function create()
    {
        
        $data =<<<EOL
{
    "attr_form": {
        "attrs": {
            "caption" : "新建组件属性",
            "formColor" : "box-info",
            "buttons": [{
                "name" : "Submit",
                "class" : "btn-info",
                "event" : "submit"
            }],
            "action" : {
                "uri" : "/api/attr",
                "method" : "POST",
                "success" : {
                    "redirect" : "/attrs"
                }
            }
        },
        "fields": {
            "attr_name": {
                "name": "属性名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "属性名"
                },
                "value": ""
            },
            "attr_name_cn": {
                "name": "显示中文名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "显示中文名"
                },
                "value": ""
            },
            "attr_type": {
                "name": "属性类别",
                "type": "select",
                "value": "string",
                "data": [
                    {
                        "value": "string",
                        "text": "string"
                    },
                    {
                        "value": "integer",
                        "text": "integer"
                    },
                    {
                        "value": "float",
                        "text": "float"
                    },
                    {
                        "value": "boolean",
                        "text": "boolean"
                    },
                    {
                        "value": "array",
                        "text": "array"
                    },
                    {
                        "value": "json",
                        "text": "json"
                    }
                ]
            },
            "form_type":{
                "name": "渲染类别",
                "type": "select",
                "value": "input",
                "data": [
                    {
                        "value": "input",
                        "text": "input"
                    },
                    {
                        "value": "select",
                        "text": "select"
                    },
                    {
                        "value": "checkbox",
                        "text": "checkbox"
                    },
                    {
                        "value": "radio",
                        "text": "radio"
                    },
                    {
                        "value": "keyOrValue",
                        "text": "keyOrValue"
                    }
                ]
            }
        }
    }
}        
EOL;
        return $this->renderForm($data);
    }
    
}


