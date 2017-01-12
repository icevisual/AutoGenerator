{
    "table_form": {
        "attrs": {
            "caption" : "新建表",
            "formColor" : "box-info",
            "buttons": {
                "preinstall": {
                    "submit": true,
                    "cancel": true
                }
            },
            "action" : {
                "uri" : "/api/table",
                "method" : "POST",
                "success" : {
                    "redirect" : "/tables"
                }
            }
        },
        "fields": {
            "TABLE_NAME": {
                "name": "表名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "表名"
                },
                "value": ""
            },
            "TABLE_COMMENT": {
                "name": "表备注",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "表备注"
                },
                "value": ""
            }
        }
    },
    "table": {
        "type" : "table",
        "attrs": {
            "caption": "字段列表",
            "RESTful" : true,
            "ajax" : false,
            "uris" : {
                "query" : {
                    "url" : "/api/tables",
                    "param" : [],
                    "method" : "GET"
                }
            },
            "rownum" : true,
            "hidden" : {
                "id" : true
            },
            "operation" : true,
            "operations" : [{
                "name" : "R",
                "class" : "btn-warning",
                "event" : "reomve"
            },{
                "name" : "U",
                "class" : "btn-info",
                "event" : "update"
            },{
                "name" : "^",
                "class" : "btn-info",
                "event" : "up"
            },{
                "name" : "v",
                "class" : "btn-info",
                "event" : "down"
            }],
            "header": [
                "字段",
                "名称",
                "类型",
                "允许空",
                "默认值"
            ]
        },
        "data": {
            "total": 0,
            "current_page": 0,
            "last_page": 0,
            "per_page": 10,
            "list" : []
        }
    },
    "column_form": {
        "attrs": {
            "caption" : "字段编辑",
            "formColor" : "box-info",
            "buttons": {
                "preinstall": {
                    "submit": false,
                    "cancel": false
                },
                "others" : [{
                    "class" : "btn-info",
                    "event" : "submit",
                    "name"  : "Submit"
                }]
            },
            "action" : {
                "uri" : "/api/table",
                "method" : "POST",
                "success" : {
                    "redirect" : "/tables"
                }
            }
        },
        "fields": {
            "COLUMN_NAME": {
                "name": "字段名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "字段名"
                },
                "value": ""
            },
            "COLUMN_NAME_CN": {
                "name": "中文字段名",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "中文字段名"
                },
                "value": ""
            },
            "COLUMN_DEFAULT": {
                "name": "默认值",
                "type": "input",
                "validate" : {
                    "rules" : "sometimes"
                },
                "attrs": {
                    "type": "text",
                    "placeholder": "默认值"
                },
                "value": ""
            },
            "IS_NULLABLE": {
                "name": "允许空",
                "type": "select",
                "value": "YES",
                "data": [
                    {
                        "value": "YES",
                        "text": "YES"
                    },
                    {
                        "value": "NO",
                        "text": "NO"
                    }
                ]
            },
            "DATA_TYPE": {
                "name": "数据类型",
                "type": "select",
                "value": "varchar",
                "data": [
                    {
                        "value": "bigint",
                        "text": "bigint"
                    },
                    {
                        "value": "char",
                        "text": "char"
                    },
                    {
                        "value": "date",
                        "text": "date"
                    },
                    {
                        "value": "datetime",
                        "text": "datetime"
                    },
                    {
                        "value": "decimal",
                        "text": "decimal"
                    },
                    {
                        "value": "double",
                        "text": "double"
                    },
                    {
                        "value": "float",
                        "text": "float"
                    },
                    {
                        "value": "int",
                        "text": "int"
                    },
                    {
                        "value": "mediumint",
                        "text": "mediumint"
                    },
                    {
                        "value": "mediumtext",
                        "text": "mediumtext"
                    },
                    {
                        "value": "smallint",
                        "text": "smallint"
                    },
                    {
                        "value": "text",
                        "text": "text"
                    },
                    {
                        "value": "time",
                        "text": "time"
                    },
                    {
                        "value": "timestamp",
                        "text": "timestamp"
                    },
                    {
                        "value": "tinyint",
                        "text": "tinyint"
                    },
                    {
                        "value": "varchar",
                        "text": "varchar"
                    }
                ]
            },
            "CHARACTER_MAXIMUM_LENGTH": {
                "name": "字符长度",
                "type": "input",
                "validate" : {
                    "rules" : "sometimes"
                },
                "attrs": {
                    "type": "text",
                    "placeholder": "字符长度"
                },
                "value": ""
            },
            "NUMERIC_PRECISION": {
                "name": "位数",
                "type": "input",
                "validate" : {
                    "rules" : "sometimes"
                },
                "attrs": {
                    "type": "text",
                    "placeholder": "位数"
                },
                "value": ""
            },
            "NUMERIC_SCALE": {
                "name": "精度",
                "type": "input",
                "validate" : {
                    "rules" : "sometimes"
                },
                "attrs": {
                    "type": "text",
                    "placeholder": "精度"
                },
                "value": ""
            },
            "COLUMN_COMMENT": {
                "name": "备注",
                "type": "input",
                "attrs": {
                    "type": "text",
                    "placeholder": "备注"
                },
                "value": ""
            }
        }
    }
}