

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
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[{"group":"MAIN NAVIGATION","menus":[{"icon":"fa-dashboard","title":"Demo","submenus":[{"href":"http:\/\/192.168.5.11:17778\/demo","icon":"fa-circle-o","title":"List Demo"},{"href":"http:\/\/192.168.5.11:17778\/demo\/create","icon":"fa-circle-o","title":"Form Demo"}]},{"icon":"fa-files-o","title":"Layout Options","submenus":[{"href":"http:\/\/192.168.5.11:17778\/attrs","icon":"fa-circle-o","title":"ATTRS LIST","active":true},{"href":"http:\/\/192.168.5.11:17778\/attr","icon":"fa-circle-o","title":"ATTRS CREATE"},{"href":"http:\/\/192.168.5.11:17778\/components","icon":"fa-circle-o","title":"COMPONENTS LIST"},{"href":"http:\/\/192.168.5.11:17778\/component","icon":"fa-circle-o","title":"COMPONENTS CREATE"}],"active":true}]}]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[{"group":"MAIN NAVIGATION","menus":[{"icon":"fa-dashboard","title":"Demo","submenus":[{"href":"http:\/\/automation.local.com\/demo","icon":"fa-circle-o","title":"List Demo"},{"href":"http:\/\/automation.local.com\/demo\/create","icon":"fa-circle-o","title":"Form Demo","active":true}],"active":true},{"icon":"fa-files-o","title":"Layout Options","submenus":[{"href":"http:\/\/automation.local.com\/attrs","icon":"fa-circle-o","title":"ATTRS LIST"},{"href":"http:\/\/automation.local.com\/attr","icon":"fa-circle-o","title":"ATTRS CREATE"},{"href":"http:\/\/automation.local.com\/components","icon":"fa-circle-o","title":"COMPONENTS LIST"},{"href":"http:\/\/automation.local.com\/component","icon":"fa-circle-o","title":"COMPONENTS CREATE"}]}]}]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[{"group":"MAIN NAVIGATION","menus":[{"icon":"fa-dashboard","title":"Demo","submenus":[{"href":"http:\/\/localhost:17778\/demo","icon":"fa-circle-o","title":"List Demo"},{"href":"http:\/\/localhost:17778\/demo\/create","icon":"fa-circle-o","title":"Form Demo"}]},{"icon":"fa-files-o","title":"Layout Options","submenus":[{"href":"http:\/\/localhost:17778\/attrs","icon":"fa-circle-o","title":"ATTRS LIST"},{"href":"http:\/\/localhost:17778\/attr","icon":"fa-circle-o","title":"ATTRS CREATE","active":true},{"href":"http:\/\/localhost:17778\/components","icon":"fa-circle-o","title":"COMPONENTS LIST"},{"href":"http:\/\/localhost:17778\/component","icon":"fa-circle-o","title":"COMPONENTS CREATE"}],"active":true}]}]}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/sidebar
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/formConfig api/formConfig-GET
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
     * @api {POST} api/attr api/attr-POST
     * @apiName POST-api_attr
     * @apiGroup Open_Web
     *
     * @apiParam {String} [id=0] 属性名称-中文
     * @apiParam {String} attr_name_cn 属性名称-中文
     * @apiParam {String} attr_name_en 属性名称-英文
     * @apiParam {String} attr_type 属性数据类型
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"12312","attr_name_en":"3123123","attr_type":"integer","id":12}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"\u7684\u7684\u8428\u82ac","attr_name_en":"\u6c83\u5c14\u6c83\u4eba","attr_type":"integer","id":11}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/attrs api/attrs-GET
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
     *{"code":1,"msg":"OK","data":{"total":5,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"},{"id":6,"attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string"},{"id":8,"attr_name_cn":"adfsdfs","attr_name_en":"123123er","attr_type":"integer"},{"id":9,"attr_name_cn":"sadfadfs","attr_name_en":"dsafdsagsafasdf","attr_type":"string"},{"id":10,"attr_name_cn":"\u963f\u9053\u592b\u8428\u8fbe\u6492\u5927\u653e\u9001","attr_name_en":"fasdfasd","attr_type":"float"}]}}
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
     *{"code":1,"msg":"OK","data":{"total":5,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":6,"attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string"},{"id":8,"attr_name_cn":"adfsdfs","attr_name_en":"123123er","attr_type":"integer"},{"id":9,"attr_name_cn":"sadfadfs","attr_name_en":"dsafdsagsafasdf","attr_type":"string"},{"id":10,"attr_name_cn":"\u963f\u9053\u592b\u8428\u8fbe\u6492\u5927\u653e\u9001","attr_name_en":"fasdfasd","attr_type":"float"},{"id":11,"attr_name_cn":"\u7684\u7684\u8428\u82ac","attr_name_en":"\u6c83\u5c14\u6c83\u4eba","attr_type":"integer"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":4,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":2,"attr_name_cn":"1231123","attr_name_en":"121233","attr_type":"boolean"},{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"},{"id":4,"attr_name_cn":"\u6253\u53d1\u6253\u53d1\u6492","attr_name_en":"1123123sad","attr_type":"boolean"},{"id":5,"attr_name_cn":"1232333123","attr_name_en":"dsaffds","attr_type":"float"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"\u6253\u53d1\u6253\u53d1\u6492","attr_name_en":"1231233123123sad","attr_type":"boolean","id":4}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":2,"per_page":"1","list":[{"id":1,"attr_name_cn":"123","attr_name_en":"123123","attr_type":"string"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name_cn":"\u7b54\u590d","attr_name_en":"aaaaa","attr_type":"float","id":3}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":4,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_name_en":"aaaaa123","attr_type":"float"},{"id":6,"attr_name_cn":"dfsasdf","attr_name_en":"123123","attr_type":"string"},{"id":8,"attr_name_cn":"adfsdfs","attr_name_en":"123123er","attr_type":"integer"},{"id":9,"attr_name_cn":"sadfadfs","attr_name_en":"dsafdsagsafasdf","attr_type":"string"}]}}
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
     * @api {GET} api/attr/{id} api/attr/{id}-GET
     * @apiName GET-api_attr_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_form":{"attrs":{"caption":"\u65b0\u5efa\u7ec4\u4ef6\u5c5e\u6027","formColor":"box-warning","action":{"uri":"\/api\/attrs","method":"POST","success":{"redirect":"\/attrs"}}},"fields":{"id":{"name":"\u5c5e\u6027 ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":3},"attr_name_cn":{"name":"\u5c5e\u6027\u540d\u5b57\u4e2d","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u5c5e\u6027\u540d\u5b57\u4e2d"},"value":"\u7b54\u590d1232"},"attr_name_en":{"name":"\u5c5e\u6027\u540d\u5b57\u82f1","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u540d\u5b57\u82f1"},"value":"aaaaa123"},"attr_type":{"name":"\u5c5e\u6027\u7c7b\u522b","type":"select","value":"float","data":[{"value":"string","text":"string"},{"value":"integer","text":"integer"},{"value":"float","text":"float"},{"value":"boolean","text":"boolean"}]}}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {PUT} api/attr/{id} api/attr/{id}-PUT
     * @apiName PUT-api_attr_{id}
     * @apiGroup Open_Web
     *
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_form":{"attrs":{"caption":"\u65b0\u5efa\u7ec4\u4ef6\u5c5e\u6027","formColor":"box-warning","action":{"uri":"\/api\/attrs","method":"POST","success":{"redirect":"\/attrs"}}},"fields":{"id":{"name":"\u5c5e\u6027 ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":3},"attr_name_cn":{"name":"\u5c5e\u6027\u540d\u5b57\u4e2d","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u5c5e\u6027\u540d\u5b57\u4e2d"},"value":"\u7b54\u590d1232"},"attr_name_en":{"name":"\u5c5e\u6027\u540d\u5b57\u82f1","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u540d\u5b57\u82f1"},"value":"aaaaa123"},"attr_type":{"name":"\u5c5e\u6027\u7c7b\u522b","type":"select","value":"float","data":[{"value":"string","text":"string"},{"value":"integer","text":"integer"},{"value":"float","text":"float"},{"value":"boolean","text":"boolean"}]}}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {DELETE} api/attr/{id} api/attr/{id}-DELETE
     * @apiName DELETE-api_attr_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_form":{"attrs":{"caption":"\u65b0\u5efa\u7ec4\u4ef6\u5c5e\u6027","formColor":"box-warning","action":{"uri":"\/api\/attrs","method":"POST","success":{"redirect":"\/attrs"}}},"fields":{"id":{"name":"\u5c5e\u6027 ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":3},"attr_name_cn":{"name":"\u5c5e\u6027\u540d\u5b57\u4e2d","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u5c5e\u6027\u540d\u5b57\u4e2d"},"value":"\u7b54\u590d1232"},"attr_name_en":{"name":"\u5c5e\u6027\u540d\u5b57\u82f1","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u540d\u5b57\u82f1"},"value":"aaaaa123"},"attr_type":{"name":"\u5c5e\u6027\u7c7b\u522b","type":"select","value":"float","data":[{"value":"string","text":"string"},{"value":"integer","text":"integer"},{"value":"float","text":"float"},{"value":"boolean","text":"boolean"}]}}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/attr/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {POST} api/component api/component-POST
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
     *{"code":1,"msg":"OK","data":{"component_name":"text","component_desc":"\u8f93\u5165\u6846","id":5}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"123","component_desc":"123123123","id":1}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"\u5927\u6cd5\u5e08","component_desc":"12312312","id":6}}
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
     * @api {GET} api/components api/components-GET
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
     *{"code":1,"msg":"OK","data":{"total":1,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":4,"component_name":"13123","component_desc":"123123123"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":1,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":5,"component_name":"text","component_desc":"\u8f93\u5165\u6846"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":1,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":1,"component_name":"123","component_desc":"123123123"},{"id":2,"component_name":"123123123","component_desc":"123123123"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":3,"component_name":"\u5448\u73b0\u51favxvcxcvx","component_desc":"\u5927\u65b9\u7684\u8bf4\u6cd5\u7684\u51af\u7ecd\u5cf0"},{"id":4,"component_name":"13123","component_desc":"123123123"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":5,"component_name":"text","component_desc":"\u8f93\u5165\u6846"},{"id":6,"component_name":"\u5927\u6cd5\u5e08","component_desc":"12312312"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":0,"current_page":1,"last_page":0,"per_page":10,"list":[]}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/components
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/component/{id} api/component/{id}-GET
     * @apiName GET-api_component_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_attrs_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"ajax":true,"rownum":false,"hidden":[],"operation":true,"operations":{"addbind":{"color":"btn-success","text":"+"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d\u4e2d","\u5c5e\u6027\u540d\u82f1","\u6570\u636e\u7c7b\u578b"]},"data":{"total":"2","current_page":"1","last_page":"1","per_page":"10","list":[]}},"attrs_bind_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","ajax":false,"uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"rownum":true,"hidden":[],"advancedColumn":{"default_value":{"type":"input"}},"operation":true,"operations":{"attrunbind":{"color":"btn-warning","text":"R"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d\u4e2d","\u6570\u636e\u7c7b\u578b","\u9ed8\u8ba4\u503c"]},"data":{"total":"3","current_page":"1","last_page":"1","per_page":"10","list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_type":"float","default_value":"\u4e5f\u592a\u70ed\u53c81"}]}},"component_form":{"attrs":{"caption":"\u7ec4\u4ef6","buttons":{"preinstall":{"submit":"1","cancel":"1"}},"action":{"uri":"\/api\/component","method":"PUT","success":{"redirect":"\/components"}}},"fields":{"id":{"name":" ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":5},"component_name":{"name":"\u7ec4\u4ef6\u540d\u79f0","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u7ec4\u4ef6\u540d\u79f0"},"value":"text"},"component_desc":{"name":"\u7ec4\u4ef6\u63cf\u8ff0","type":"input","attrs":{"type":"text","placeholder":"\u7ec4\u4ef6\u63cf\u8ff0"},"value":"\u8f93\u5165\u6846"}}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/component/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {PUT} api/component api/component-PUT
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
     *{"code":1,"msg":"OK","data":{"component_name":"text","component_desc":"\u8f93\u5165\u6846","id":5}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"123","component_desc":"123123123","id":1}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_name":"\u5927\u6cd5\u5e08","component_desc":"12312312","id":6}}
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
     * @api {DELETE} api/component/{id} api/component/{id}-DELETE
     * @apiName DELETE-api_component_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_attrs_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"ajax":true,"rownum":false,"hidden":[],"operation":true,"operations":{"addbind":{"color":"btn-success","text":"+"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d\u4e2d","\u5c5e\u6027\u540d\u82f1","\u6570\u636e\u7c7b\u578b"]},"data":{"total":"2","current_page":"1","last_page":"1","per_page":"10","list":[]}},"attrs_bind_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","ajax":false,"uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"rownum":true,"hidden":[],"advancedColumn":{"default_value":{"type":"input"}},"operation":true,"operations":{"attrunbind":{"color":"btn-warning","text":"R"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d\u4e2d","\u6570\u636e\u7c7b\u578b","\u9ed8\u8ba4\u503c"]},"data":{"total":"3","current_page":"1","last_page":"1","per_page":"10","list":[{"id":3,"attr_name_cn":"\u7b54\u590d1232","attr_type":"float","default_value":"\u4e5f\u592a\u70ed\u53c81"}]}},"component_form":{"attrs":{"caption":"\u7ec4\u4ef6","buttons":{"preinstall":{"submit":"1","cancel":"1"}},"action":{"uri":"\/api\/component","method":"PUT","success":{"redirect":"\/components"}}},"fields":{"id":{"name":" ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":5},"component_name":{"name":"\u7ec4\u4ef6\u540d\u79f0","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u7ec4\u4ef6\u540d\u79f0"},"value":"text"},"component_desc":{"name":"\u7ec4\u4ef6\u63cf\u8ff0","type":"input","attrs":{"type":"text","placeholder":"\u7ec4\u4ef6\u63cf\u8ff0"},"value":"\u8f93\u5165\u6846"}}}}}
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
     * @apiParam {String} [p=1] 页数
     * @apiParam {String} [n=10] 每页条数
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