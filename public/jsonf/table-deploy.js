{
    "table": {
        "attrs": {
            "caption": "组表",
            "uris" : {
                "query" : {
                    "url" : "/api/attrs",
                    "param" : [],
                    "method" : "GET"
                },
                "save" : {
                    "url" : "/api/table/deploy",
                    "param" : [],
                    "method" : "POST",
                    "success" : {
                        "redirect" : "/tables"
                    }
                }
            },
            "ajax" : true,
            "rownum" : true,
            "pagination" : false,
            "hidden" : {
            },
            "operation" : false,
            "operations" : {
                "addbind" : {
                    "class" : "btn-success",
                    "name" : "+"
                }
            },
            "advancedColumn" : {
                "validate" : {
                    "type" : "input"
                }
            },
            "headerTools" : [{
                "name" : "Submit",
                "class" : "btn-info",
                "event" : "submit"
            }],
            "header": [
                "字段",
                "列名",
                "默认值",
                "允许空",
                "类型定义",
                {
                    "name" : "验证规则",
                    "width" : "500px"
                }
            ]
        },
        "data": {
            "total": 2,
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "list" : []
        }
    },
    "component_form": {
        "attrs": {
            "caption": "组件",
            "buttons": {
                "preinstall": {
                    "submit": false,
                    "cancel": true
                },
                "others" : [
                    {
                        "name":"submit",
                        "class" : "btn-info",
                        "event" : "submit"
                    }
                ]
            },
            "action" : {
                "uri" : "/api/component",
                "method" : "POST",
                "success" : {
                    "redirect" : "/components"
                }
            }
        },
        "fields": {
            "component_name": {
                "name": "组件名称",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "default": "asdda",
                    "placeholder": "组件名称"
                },
                "value": ""
            },
            "component_desc": {
                "name": "组件描述",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "组件描述"
                },
                "value": ""
            }
        }
    }
}