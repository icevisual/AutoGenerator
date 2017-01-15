{
    "table": {
        "attrs": {
            "caption": "组表",
            "uris" : {
                "save" : {
                    "url" : "/api/table/{id}/deploy",
                    "param" : ["id"],
                    "method" : "POST",
                    "success" : {
                        "redirect" : "/tables"
                    }
                },
                "update" : {
                    "url" : "/table/{id}",
                    "param" : ["id"],
                    "method" : "GET"
                }
            },
            "ajax" : false,
            "rownum" : true,
            "pagination" : false,
            "hidden" : {
                "id" : true
            },
            "operation" : false,
            "data" : {},
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
                "event" : "savevalidation"
            },{
                "name" : "U",
                "class" : "btn-info",
                "event" : "redirect", 
                "uri" : "update"
            }],
            "header": {
                "COLUMN_NAME" : "字段",
                "COLUMN_NAME_CN" : "列名",
                "COLUMN_DEFAULT" : "默认值",
                "IS_NULLABLE" : "允许空",
                "DATA_TYPE" : "类型定义",
                "validate" : {
                    "name" : "验证规则",
                    "width" : "500px"
                }
            }
        },
        "data": {
            "total": 0,
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "list" : []
        }
    }
}