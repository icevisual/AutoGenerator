{
    "code": 1,
    "msg": "OK",
    "data": {
        "attr_form": {
            "attrs": {
                "caption" : "新建组件属性",
                "formColor" : "box-info",
                "buttons": {
                    "preinstall": {
                        "submit": true,
                        "cancel": true
                    },
                    "others" : [{
                        "class" : "btn-warning",
                        "event" : "other",
                        "name"  : "other"
                    }]
                },
                "action" : {
                    "uri" : "/api/attr",
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