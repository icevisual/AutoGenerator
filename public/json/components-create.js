{
    "code": 1,
    "msg": "OK",
    "data": {
        "attrs_list": {
            "1": {
                "attr_id": "1",
                "attr_name_cn": "attr_name_cn",
                "attr_name_en": "attr_name_en",
                "attr_type": "string"
            }
        },
        "component_attrs_table": {
            "attrs": {
                "caption": "组件属性表",
                "RESTful" : true,
                "uris" : {
                    "query" : {
                        "url" : "/api/attrs",
                        "param" : [],
                        "method" : "GET"
                    },
                    "update" : {
                        "url" : "/attrs/create/{id}",
                        "param" : ["id"],
                        "method" : "GET"
                    },
                    "delete" : {
                        "url" : "/api/attrs/{id}",
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
                "header": [
                    {
                        "name": "属性名中"
                    },
                    {
                        "name": "属性名英"
                    },
                    {
                        "name": "数据类型"
                    }
                ]
            },
            "data": {
                "list" : {
                    "attr_name_cn": "Update software",
                    "attr_name_en": "Update software",
                    "attr_type": "attr_type",
                    "default_value": "default_value"
                }
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