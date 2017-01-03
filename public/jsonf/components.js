{
    "table": {
        "attrs": {
            "caption": "组件表",
            "RESTful" : true,
            "ajax" : true,
            "uris" : {
                "query" : {
                    "url" : "/api/components",
                    "param" : [],
                    "method" : "GET"
                },
                "update" : {
                    "url" : "/component/{id}",
                    "param" : ["id"],
                    "method" : "GET"
                },
                "delete" : {
                    "url" : "/api/component/{id}",
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
                    "name": "组件名称",
                    "width":"200px"
                },
                "组件描述"
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