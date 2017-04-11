<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    
    
    public function layout(){
        $layout =<<<EOL
{
    "content-header": "General Form Elements",
    "content-header-small": "preview of simple tables",
    "content": [
        [
            {
                "col-class": "col-md-3",
                "dcontent": [
                    {
                        "ele": "common-form",
                        "selector": "config_form"
                    },
                    {
                        "ele": "common-form",
                        "selector": "layout_form"
                    }
                ]
            },
            {
                "col-class": "col-md-9",
                "dcontent": [
                    {
                        "ele": "common-table",
                        "selector": "attrs_table"
                    }
                ]
            }
        ]
    ]
}
EOL;
        $layout = json_decode($layout,1);
        $data =<<<EOL
{
    "attrs_table": {
        "type" : "table",
        "attrs": {
            "caption": "属性表",
            "RESTful" : true,
            "ajax" : false,
            "uris" : {
                "query" : {
                    "url" : "/api/attrs",
                    "param" : [],
                    "method" : "GET"
                },
                "update" : {
                    "url" : "/attr/{id}",
                    "param" : ["id"],
                    "method" : "GET"
                },
                "delete" : {
                    "url" : "/api/attr/{id}",
                    "param" : ["id"],
                    "method" : "DELETE"
                }
            },
            "rownum" : true,
            "hidden" : {
                "id" : true
            },
            "operation" : true,
            "operations" : {
                "update" : true,
                "delete" : true
            },
            "header": {
                "node_type" : {
                    "name": "属性名",
                    "width":"200px"
                },
                "selector" : "显示名称"
            }
        },
        "data": {
            "total": 2,
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "list" : []
        }
    },
    "config_form": {
        "attrs": {
            "caption" : "配置管理",
            "formColor" : "box-info",
            "buttons": [{
                "name" : "Add Node",
                "class" : "btn-info",
                "event" : "addnode"
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
            "content-header": {
                "name": "标题",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "标题"
                },
                "value": ""
            },
            "content-header-smell": {
                "name": "小标题",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "小标题"
                },
                "value": ""
            }
        }
    },
    "layout_form": {
        "attrs": {
            "caption" : "节点编辑",
            "formColor" : "box-info",
            "buttons": [{
                "name" : "Add Node",
                "class" : "btn-info",
                "event" : "addnode"
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
            "node_type": {
                "name": "节点类别",
                "type": "select",
                "value": "horizontal-form",
                "data": [
                    {
                        "value": "horizontal-form",
                        "text": "HorizontalForm"
                    },
                    {
                        "value": "common-form",
                        "text": "CommonForm"
                    },
                    {
                        "value": "common-table",
                        "text": "CommonTable"
                    }
                ]
            },
            "selector": {
                "name": "Key",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "Key"
                },
                "value": ""
            }
        }
    }
}
EOL;
        return $this->renderTemplate([
            'formConfig' => $data,
            'layout' => $layout
        ]);
    }
    
    
}
