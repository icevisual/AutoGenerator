{
    "layout" : {
        "content-header": "General Form Elements",
        "content-header-small": "preview of simple tables",
        "content": [
            {
                "col-class": "col-md-6",
                "dcontent": [
                    {
                        "ele": "horizontal-form",
                        "selector": "attr_form"
                    },
                    {
                        "ele": "common-table",
                        "selector": "attr_table"
                    }
                ]
            }
        ]
    },
    "attr_form": {
        "attrs": {
            "caption" : "新建组件属性",
            "formColor" : "box-info",
            "buttons": [{
                "name" : "Submit",
                "class" : "btn-info",
                "event" : "submit"
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
            "attr_name": {
                "name": "属性名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "属性名"
                },
                "value": ""
            },
            "attr_name_input": {
                "name": "属性名",
                "tag": "input",
                "validate" : {
                    "rules" : "required|max:10",
                    "messages" : {
                        "required" : "该字段必填",
                        "max" : "该字段最多占 10 个字符"
                    }
                },
                "renderAttrs" : {
                    "type": "text",
                    "placeholder": "属性名"
                },
                "event" : {
                    "click" : "1" 
                },
                "value": ""
            },
            "attr_type_select": {
                "name": "属性类别",
                "tag": "select",
                "value": "string",
                "data": [
                    {
                        "value": "string",
                        "text": "string"
                    },
                    {
                        "value": "integer",
                        "text": "integer"
                    }
                ]
            },
            "attr_name_cn": {
                "name": "显示中文名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "显示中文名"
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
                    },
                    {
                        "value": "keyOrValue",
                        "text": "keyOrValue"
                    }
                ]
            }
        }
    }
}