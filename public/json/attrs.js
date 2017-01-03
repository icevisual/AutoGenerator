{
    "code": 1,
    "msg": "OK",
    "data": {
        "attrs_table": {
            "attrs": {
                "caption": "属性表",
                "RESTful" : true,
                "ajax" : true,
                "uris" : {
                    "query" : {
                        "url" : "/api/attrs",
                        "param" : [],
                        "method" : "GET"
                    },
                    "update" : {
                        "url" : "/attr/{id}",
                        "param" : ["id"],
                        "method" : "GET"
                    },
                    "delete" : {
                        "url" : "/api/attr/{id}",
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
                        "name": "属性名",
                        "width":"200px"
                    },
                    "显示名称",
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
        }
    }
}