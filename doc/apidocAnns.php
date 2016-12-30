

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/sidebar 获取左侧菜单
     * @apiName GET-api_sidebar
     * @apiGroup Open_Web
     *
     * @apiParam {String} pathname unknown
     *
     *
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/sidebar
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/formConfig GET-api/formConfig
     * @apiName GET-api_formConfig
     * @apiGroup Open_Web
     *
     * @apiParam {String} pathname unknown
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"componentForm":{"component_name":{"name":"\u7ec4\u4ef6\u540d\u79f0","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u7ec4\u4ef6\u540d\u79f0"},"value":""},"component_desc":{"name":"\u7ec4\u4ef6\u63cf\u8ff0","type":"input","attrs":{"type":"text","placeholder":"\u7ec4\u4ef6\u63cf\u8ff0"},"value":""}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/formConfig
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {POST} api/attr POST-api/attr
     * @apiName POST-api_attr
     * @apiGroup Open_Web
     *
     * @apiParam {String} [id=0] 属性名称-中文
     * @apiParam {String} attr_name_cn 属性名称-中文
     * @apiParam {String} attr_name_en 属性名称-英文
     * @apiParam {String} attr_type 属性数据类型
     *
     *
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/attrs GET-api/attrs
     * @apiName GET-api_attrs
     * @apiGroup Open_Web
     *
     * @apiParam {String} [p=1] 页数
     * @apiParam {String} [n=10] 每页条数
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"asdfasd","attr_name_en":"fasdfasd","attr_type":"float","id":10}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"sadfadfs","attr_name_en":"dsafdsagsafasdf","attr_type":"string","id":9}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string","id":6}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":1,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"saddafs","attr_name_en":"sadfdffsa","attr_type":"integer","id":7}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":1,"attr_name_cn":"123","attr_name_en":"123123","attr_type":"string"},{"id":2,"attr_name_cn":"1231","attr_name_en":"121233","attr_type":"string"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":3,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":1,"attr_name_cn":"123","attr_name_en":"123123","attr_type":"string"},{"id":2,"attr_name_cn":"1231","attr_name_en":"121233","attr_type":"string"},{"id":3,"attr_name_cn":"\u7b54\u590d","attr_name_en":"aaaaa","attr_type":"float"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":3,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"},{"id":6,"attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string"},{"id":8,"attr_name_cn":"adfsdfs","attr_name_en":"123123er","attr_type":"integer"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":4,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":2,"attr_name_cn":"1231123","attr_name_en":"121233","attr_type":"boolean"},{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"},{"id":4,"attr_name_cn":"\u6253\u53d1\u6253\u53d1\u6492","attr_name_en":"1123123sad","attr_type":"boolean"},{"id":5,"attr_name_cn":"1232333123","attr_name_en":"dsaffds","attr_type":"float"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"\u6253\u53d1\u6253\u53d1\u6492","attr_name_en":"1231233123123sad","attr_type":"boolean","id":4}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":2,"per_page":"1","list":[{"id":1,"attr_name_cn":"123","attr_name_en":"123123","attr_type":"string"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"\u7b54\u590d","attr_name_en":"aaaaa","attr_type":"float","id":3}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"},{"id":6,"attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string"}]}}
     *
     *
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u5c5e\u6027\u540d\u79f0-\u82f1\u6587 \u5df2\u7ecf\u5b58\u5728\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u5c5e\u6027\u540d\u79f0-\u4e2d\u6587 \u4e0d\u80fd\u4e3a\u7a7a\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u5c5e\u6027 \u4e0d\u5b58\u5728\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"The \u5c5e\u6027\u540d\u79f0-\u4e2d\u6587 has already been taken.","data":[]}
     *
     * @apiSampleRequest http://automation.local.com//api/attrs
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/attr/{id} GET-api/attr/{id}
     * @apiName GET-api_attr_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {PUT} api/attr/{id} PUT-api/attr/{id}
     * @apiName PUT-api_attr_{id}
     * @apiGroup Open_Web
     *
     *
     *
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {DELETE} api/attr/{id} DELETE-api/attr/{id}
     * @apiName DELETE-api_attr_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {POST} api/component POST-api/component
     * @apiName POST-api_component
     * @apiGroup Open_Web
     *
     * @apiParam {String} component_name 控件名称
     * @apiParam {String} component_desc 控件描述
     * @apiParam {String} attrs 属性数据类型
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"123","component_desc":"123123123","id":1}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0","id":3}}
     *
     *
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u7ec4\u4ef6\u540d\u79f0 \u5df2\u7ecf\u5b58\u5728\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u9ed8\u8ba4\u503c \u4e0d\u80fd\u4e3a\u7a7a\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u63a7\u4ef6\u540d\u79f0 \u4e0d\u80fd\u4e3a\u7a7a\u3002","data":[]}
     *
     * @apiSampleRequest http://automation.local.com//api/component
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/components GET-api/components
     * @apiName GET-api_components
     * @apiGroup Open_Web
     *
     * @apiParam {String} [p=1] 页数
     * @apiParam {String} [n=10] 每页条数
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":2,"component_name":"123123123","component_desc":"123123123"},{"id":3,"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":1,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":1,"component_name":"123","component_desc":"123123123"},{"id":2,"component_name":"123123123","component_desc":"123123123"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0"},{"id":4,"component_name":"13123","component_desc":"123123123"}]}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/components
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/component/{id} GET-api/component/{id}
     * @apiName GET-api_component_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/component/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {PUT} api/component PUT-api/component
     * @apiName PUT-api_component
     * @apiGroup Open_Web
     *
     * @apiParam {String} id 组件名称
     * @apiParam {String} component_name 组件名称
     * @apiParam {String} component_desc 组件描述
     * @apiParam {String} attrs 属性数据类型
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"123","component_desc":"123123123","id":1}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0","id":3}}
     *
     *
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u7ec4\u4ef6\u540d\u79f0 \u5df2\u7ecf\u5b58\u5728\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u9ed8\u8ba4\u503c \u4e0d\u80fd\u4e3a\u7a7a\u3002","data":[]}
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u63a7\u4ef6\u540d\u79f0 \u4e0d\u80fd\u4e3a\u7a7a\u3002","data":[]}
     *
     * @apiSampleRequest http://automation.local.com//api/component
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {DELETE} api/component/{id} DELETE-api/component/{id}
     * @apiName DELETE-api_component_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/component/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/external/components/list 获取控件列表以及控件属性
     * @apiName GET-api_external_components_list
     * @apiGroup Open_Web
     *
     *
     * @apiSuccess {String} component_name 控件名称
     * @apiSuccess {String} component_desc 控件描述
     * @apiSuccess {Integer} attr_id 属性ID
     * @apiSuccess {String} attr_name_cn 属性中文名称
     * @apiSuccess {String} attr_name_en 属性英文名称
     * @apiSuccess {String} attr_type 属性数据类型
     * @apiSuccess {String} default_value 属性默认值
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0","attrs":[{"attr_id":"3","attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float","default_value":"23"},{"attr_id":"9","attr_name_cn":"sadfadfs","attr_name_en":"dsafdsagsafasdf","attr_type":"string","default_value":"\u6253\u53d1\u6253\u53d1\u6492"},{"attr_id":"8","attr_name_cn":"adfsdfs","attr_name_en":"123123er","attr_type":"integer","default_value":"123"},{"attr_id":"6","attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string","default_value":"3123"}]},{"id":4,"component_name":"13123","component_desc":"123123123","attrs":[{"attr_id":"8","attr_name_cn":"adfsdfs","attr_name_en":"123123er","attr_type":"integer","default_value":"123"},{"attr_id":"6","attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string","default_value":"123"},{"attr_id":"3","attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float","default_value":"12"}]}]}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/external/components/list
     */