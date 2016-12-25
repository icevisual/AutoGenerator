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
                "header": [
                    {
                        "name": "#",
                        "width": "10px"
                    },
                    {
                        "name": "属性名中"
                    },
                    {
                        "name": "属性名英"
                    },
                    {
                        "name": "数据类型"
                    },
                    {
                        "name": "默认值"
                    }
                ]
            },
            "list": [
                {
                    "attr_name_cn": "Update software",
                    "attr_name_en": "Update software",
                    "attr_type": "attr_type",
                    "default_value": "default_value"
                }
            ]
        },
        "component_form": {
            "attrs": {
                "caption": "组件",
                "buttons": {
                    "preinstall": {
                        "submit": true,
                        "cancel": true
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
                "formColor": "box-warning"
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