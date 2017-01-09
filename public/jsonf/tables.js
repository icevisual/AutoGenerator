{
    "table": {
        "type" : "table",
        "attrs": {
            "caption": "数据表列表",
            "RESTful" : true,
            "ajax" : true,
            "uris" : {
                "query" : {
                    "url" : "/api/tables",
                    "param" : [],
                    "method" : "GET"
                },
                "update" : {
                    "url" : "/component/{id}",
                    "param" : ["id"],
                    "method" : "GET"
                },
                "deploy" : {
                    "url" : "/table/deploy/{id}",
                    "param" : ["id"],
                    "method" : "GET"
                }
            },
            "rownum" : true,
            "hidden" : {
                "id" : true
            },
            "operation" : true,
            "operations" : {
                "update" : true,
                "delete" : false,
                "deploy" : {
                    "name" : "DEPLOY",
                    "class" : "btn-info",
                    "event" : "redirect",
                    "uri" : "deploy"
                }
            },
            "header": [
                {
                    "name": "表名",
                    "width":"200px"
                },
                "描述",
                "行数",
                "空间",
                "自增长"
            ]
        },
        "data": {
            "total": 0,
            "current_page": 0,
            "last_page": 0,
            "per_page": 10,
            "list" : []
        }
    }
}