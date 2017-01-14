{
    "component_attrs_table": {
        "attrs": {
            "caption": "组件属性表",
            "uris" : {
                "query" : {
                    "url" : "/api/attrs",
                    "param" : [],
                    "method" : "GET"
                }
            },
            "ajax" : true,
            "rownum" : false,
            "hidden" : {
            },
            "operation" : true,
            "operations" : {
                "addbind" : {
                    "class" : "btn-success",
                    "name" : "+",
                    "event" : "addbind"
                }
            },
            "header": {
                "id" : {"name":"ID","width":"20px"},
                "attr_name" : "属性名",
                "attr_name_cn" : "显示名称",
                "attr_type" : "数据类型",
                "form_type" : "渲染类型"
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
    "attrs_bind_table": {
        "attrs": {
            "caption": "组件属性表",
            "ajax" : false,
            "uris" : {
                "query" : {
                    "url" : "/api/attrs",
                    "param" : [],
                    "method" : "GET"
                }
            },
            "rownum" : true,
            "hidden" : {
            },
            "advancedColumn" : {
                "default_value" : {
                    "type" : "input"
                }
            },
            "operation" : true,
            "operations" : {
                "attrunbind" : {
                    "class" : "btn-warning",
                    "name" : "R",
                    "event" : "attrunbind"
                }
            },
            "header": {
                "id" : {"name":"ID","width":"20px"},
                "attr_name" : "属性名",
                "attr_name_cn" : "显示名称",
                "attr_type" : "数据类型",
                "form_type" : "渲染类型",
                "default_value" : "属性默认值"
            }
        },
        "data": {
            "total": 3,
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "list": []
        }
    },
    "component_form": {
        "attrs": {
            "caption": "组件",
            "buttons": [{
                "name" : "Submit",
                "class" : "btn-info",
                "event" : "validate"
            }],
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