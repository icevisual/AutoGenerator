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
                        "color" : "btn-info",
                        "text" : ">"
                    }
                },
                "header": [
                    {"name":"ID","width":"20px"},
                    "属性名中",
                    "属性名英",
                    "数据类型"
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
                        "submit": true,
                        "cancel": true
                    }
                },
                "action" : {
                    "uri" : "/api/attrs",
                    "method" : "POST",
                    "success" : {
                        "redirect" : "/attrs"
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
        },
        "attr_bind_form": {
            "attrs": {
                "caption": "添加属性",
                "action" : {
                    "uri" : "/api/attrs",
                    "method" : "POST",
                    "success" : {
                        "redirect" : "/attrs"
                    }
                },
                "buttons": {
                    "preinstall": {
                        "submit": true,
                        "cancel": true
                    },
                    "others": [
                        {
                            "name": "New Attr",
                            "event": "newattr",
                            "class": "btn-primary"
                        }
                    ]
                }
            },
            "fields": {
                "attr_id": {
                    "name": "属性",
                    "type": "select",
                    "value": "1",
                    "default": "1",
                    "data": [
                        {
                            "value": "string",
                            "text": "string"
                        }
                    ]
                },
                "default_value": {
                    "name": "属性默认值",
                    "type": "input",
                    "attrs": {
                        "type": "text",
                        "placeholder": "属性默认值"
                    },
                    "value": ""
                }
            }
        },
        "attr_form": {
            "attrs": {
                "caption": "新建组件属性",
                "formColor": "box-warning",
                "action" : {
                    "uri" : "/api/attrs",
                    "method" : "POST",
                    "success" : {
                        "redirect" : "/attrs"
                    }
                }
            },
            "fields": {
                "attr_name_cn": {
                    "name": "属性名字中",
                    "type": "input",
                    "attrs": {
                        "type": "text",
                        "default": "asdda",
                        "placeholder": "属性名字中"
                    },
                    "value": ""
                },
                "attr_name_en": {
                    "name": "属性名字英",
                    "type": "input",
                    "attrs": {
                        "type": "text",
                        "placeholder": "属性名字英"
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
                        }
                    ]
                }
            }
        }
    }
}