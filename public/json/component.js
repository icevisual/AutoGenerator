{
    "code": 1,
    "msg": "OK",
    "data": {
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
                        "color" : "btn-success",
                        "text" : "+"
                    }
                },
                "header": [
                    {"name":"ID","width":"20px"},
                    "属性名",
                    "属性值",
                    "数据类型",
                    "渲染类型"
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
                        "color" : "btn-warning",
                        "text" : "R"
                    }
                },
                "header": [
                    {"name":"ID","width":"20px"},
                    "属性名中",
                    "数据类型",
                    "默认值"
                ]
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
}