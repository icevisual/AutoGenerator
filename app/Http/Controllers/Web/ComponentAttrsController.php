<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class ComponentAttrsController extends Controller
{

    public function query()
    {
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
        "data": {
            "total": 7,
            "current_page": 1,
            "last_page": 1,
            "per_page": 10000,
            "list": [
                {
                    "id": 6,
                    "attr_name": "name",
                    "attr_name_cn": "名称",
                    "attr_type": "string",
                    "form_type": "input"
                },
                {
                    "id": 7,
                    "attr_name": "type",
                    "attr_name_cn": "类型",
                    "attr_type": "array",
                    "form_type": "select"
                },
                {
                    "id": 8,
                    "attr_name": "charLength",
                    "attr_name_cn": "字符长度",
                    "attr_type": "integer",
                    "form_type": "input"
                },
                {
                    "id": 9,
                    "attr_name": "require",
                    "attr_name_cn": "是否必填",
                    "attr_type": "boolean",
                    "form_type": "checkbox"
                },
                {
                    "id": 10,
                    "attr_name": "width",
                    "attr_name_cn": "宽度",
                    "attr_type": "integer",
                    "form_type": "input"
                },
                {
                    "id": 15,
                    "attr_name": "height",
                    "attr_name_cn": "高度",
                    "attr_type": "integer",
                    "form_type": "input"
                },
                {
                    "id": 19,
                    "attr_name": "keyOrValue",
                    "attr_name_cn": "值",
                    "attr_type": "array",
                    "form_type": "keyOrValue"
                }
            ]
        }
    }
}        
        
EOL;
        return view('backend.common.attrs', [
            'formConfig' => $data
        ]);
    }

    public function create()
    {
        return view('backend.common.attr');
    }
    
}


