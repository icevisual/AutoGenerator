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
                    }
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
                "attr_name": {
                    "name": "属性名字",
                    "type": "input",
                    "attrs": {
                        "type": "text",
                        "placeholder": "属性名字中"
                    },
                    "value": ""
                },
                "attr_value": {
                    "name": "属性值",
                    "type": "input",
                    "validate" : {
                        "rules" : "sometimes"  
                    },
                    "attrs": {
                        "type": "text",
                        "placeholder": "属性值"
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
                        }
                    ]
                }
            }
        }
    }
}