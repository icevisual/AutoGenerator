

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
     *{"code":1,"msg":"OK","data":[{"group":"MAIN NAVIGATION","menus":[{"icon":"fa-dashboard","title":"Demo","submenus":[{"href":"http:\/\/automation.local.com\/demo","icon":"fa-circle-o","title":"List Demo"},{"href":"http:\/\/automation.local.com\/demo\/create","icon":"fa-circle-o","title":"Form Demo"}]},{"icon":"fa-files-o","title":"Layout Options","submenus":[{"href":"http:\/\/automation.local.com\/attrs","icon":"fa-circle-o","title":"ATTRS LIST","active":true},{"href":"http:\/\/automation.local.com\/attr","icon":"fa-circle-o","title":"ATTRS CREATE"},{"href":"http:\/\/automation.local.com\/components","icon":"fa-circle-o","title":"COMPONENTS LIST"},{"href":"http:\/\/automation.local.com\/component","icon":"fa-circle-o","title":"COMPONENTS CREATE"}],"active":true}]}]}
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
     * @apiParam {String} attr_name 属性名称
     * @apiParam {String} attr_value 属性值
     * @apiParam {String} attr_type 属性数据类型
     * @apiParam {String} form_type unknown
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_name":"f1","attr_value":"123123","attr_type":"string","form_type":"input","id":4}}
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
     *{"code":1,"msg":"OK","data":{"total":3,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":1,"attr_name":"123","attr_value":"123123","attr_type":"float","form_type":"checkbox"},{"id":2,"attr_name":"adf","attr_value":"afdfds","attr_type":"string","form_type":"input"},{"id":3,"attr_name":"asdfsad","attr_value":"asdfasdf","attr_type":"string","form_type":"input"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":4,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":1,"attr_name":"123","attr_value":"123123","attr_type":"float","form_type":"checkbox"},{"id":2,"attr_name":"adf","attr_value":"afdfds","attr_type":"string","form_type":"input"},{"id":3,"attr_name":"asdfsad","attr_value":"asdfasdf","attr_type":"string","form_type":"input"},{"id":4,"attr_name":"f1","attr_value":"123123","attr_type":"string","form_type":"input"}]}}
     *
     *
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
     *{"code":1,"msg":"OK","data":{"attr_form":{"attrs":{"caption":"\u65b0\u5efa\u7ec4\u4ef6\u5c5e\u6027","formColor":"box-info","buttons":{"preinstall":{"submit":"1","cancel":"1"}},"action":{"uri":"\/api\/attr\/1","method":"PUT","success":{"redirect":"\/attrs"}}},"fields":{"id":{"name":"\u5c5e\u6027 ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":1},"attr_name":{"name":"\u5c5e\u6027\u540d\u5b57","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u540d\u5b57\u4e2d"},"value":"123"},"attr_value":{"name":"\u5c5e\u6027\u503c","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u503c"},"value":"123123"},"attr_type":{"name":"\u5c5e\u6027\u7c7b\u522b","type":"select","value":"float","data":[{"value":"string","text":"string"},{"value":"integer","text":"integer"},{"value":"float","text":"float"},{"value":"boolean","text":"boolean"},{"value":"array","text":"array"},{"value":"json","text":"json"}]},"form_type":{"name":"\u8868\u5355\u7c7b\u522b","type":"select","value":"checkbox","data":[{"value":"input","text":"input"},{"value":"select","text":"select"},{"value":"checkbox","text":"checkbox"},{"value":"radio","text":"radio"}]}}}}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
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
     * @apiParam {String} id id
     * @apiParam {String} attr_name 属性名称
     * @apiParam {String} attr_value 属性值
     * @apiParam {String} attr_type 属性数据类型
     * @apiParam {String} form_type unknown
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"attr_form":{"attrs":{"caption":"\u65b0\u5efa\u7ec4\u4ef6\u5c5e\u6027","formColor":"box-info","buttons":{"preinstall":{"submit":"1","cancel":"1"}},"action":{"uri":"\/api\/attr\/1","method":"PUT","success":{"redirect":"\/attrs"}}},"fields":{"id":{"name":"\u5c5e\u6027 ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":1},"attr_name":{"name":"\u5c5e\u6027\u540d\u5b57","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u540d\u5b57\u4e2d"},"value":"123"},"attr_value":{"name":"\u5c5e\u6027\u503c","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u503c"},"value":"123123"},"attr_type":{"name":"\u5c5e\u6027\u7c7b\u522b","type":"select","value":"float","data":[{"value":"string","text":"string"},{"value":"integer","text":"integer"},{"value":"float","text":"float"},{"value":"boolean","text":"boolean"},{"value":"array","text":"array"},{"value":"json","text":"json"}]},"form_type":{"name":"\u8868\u5355\u7c7b\u522b","type":"select","value":"checkbox","data":[{"value":"input","text":"input"},{"value":"select","text":"select"},{"value":"checkbox","text":"checkbox"},{"value":"radio","text":"radio"}]}}}}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
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
     *{"code":1,"msg":"OK","data":{"attr_form":{"attrs":{"caption":"\u65b0\u5efa\u7ec4\u4ef6\u5c5e\u6027","formColor":"box-info","buttons":{"preinstall":{"submit":"1","cancel":"1"}},"action":{"uri":"\/api\/attr\/1","method":"PUT","success":{"redirect":"\/attrs"}}},"fields":{"id":{"name":"\u5c5e\u6027 ID","type":"input","hidden":true,"attrs":{"type":"hidden"},"value":1},"attr_name":{"name":"\u5c5e\u6027\u540d\u5b57","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u540d\u5b57\u4e2d"},"value":"123"},"attr_value":{"name":"\u5c5e\u6027\u503c","type":"input","attrs":{"type":"text","placeholder":"\u5c5e\u6027\u503c"},"value":"123123"},"attr_type":{"name":"\u5c5e\u6027\u7c7b\u522b","type":"select","value":"float","data":[{"value":"string","text":"string"},{"value":"integer","text":"integer"},{"value":"float","text":"float"},{"value":"boolean","text":"boolean"},{"value":"array","text":"array"},{"value":"json","text":"json"}]},"form_type":{"name":"\u8868\u5355\u7c7b\u522b","type":"select","value":"checkbox","data":[{"value":"input","text":"input"},{"value":"select","text":"select"},{"value":"checkbox","text":"checkbox"},{"value":"radio","text":"radio"}]}}}}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
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
     *{"code":1,"msg":"OK","data":{"component_name":"123dfsa","component_desc":"123","id":11}}
     *
     *
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u7ec4\u4ef6\u540d\u79f0 \u5df2\u7ecf\u5b58\u5728\u3002","data":[]}
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
     *{"code":1,"msg":"OK","data":{"total":3,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":8,"component_name":"123","component_desc":"12312312"},{"id":9,"component_name":"3123","component_desc":"123123123"},{"id":11,"component_name":"123dfsa","component_desc":"123"}]}}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":2,"current_page":1,"last_page":1,"per_page":10,"list":[{"id":8,"component_name":"123","component_desc":"12312312"},{"id":9,"component_name":"3123","component_desc":"123123123"}]}}
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
     *{"code":1,"msg":"OK","data":{"component_attrs_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"ajax":true,"rownum":false,"hidden":[],"operation":true,"operations":{"addbind":{"color":"btn-success","text":"+"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d","\u5c5e\u6027\u503c","\u6570\u636e\u7c7b\u578b","\u6e32\u67d3\u7c7b\u578b"]},"data":{"total":"2","current_page":"1","last_page":"1","per_page":"10","list":[]}},"attrs_bind_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","ajax":false,"uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"rownum":true,"hidden":[],"advancedColumn":{"default_value":{"type":"input"}},"operation":true,"operations":{"attrunbind":{"color":"btn-warning","text":"R"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d","\u6570\u636e\u7c7b\u578b","\u6e32\u67d3\u7c7b\u578b"]},"data":{"total":"3","current_page":"1","last_page":"1","per_page":"10","list":[{"id":2,"attr_name":"adf","attr_type":"string","form_type":"input"},{"id":3,"attr_name":"asdfsad","attr_type":"string","form_type":"input"}]}},"component_form":{"attrs":{"caption":"\u7ec4\u4ef6","buttons":{"preinstall":{"submit":false,"cancel":"1"},"others":[{"name":"submit","class":"btn-info","event":"submit"}]},"action":{"uri":"\/api\/component\/8","method":"PUT","success":{"redirect":"\/components"}}},"fields":{"id":{"name":" ID","type":"input","hidden":true,"value":8},"component_name":{"name":"\u7ec4\u4ef6\u540d\u79f0","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u7ec4\u4ef6\u540d\u79f0"},"value":"123"},"component_desc":{"name":"\u7ec4\u4ef6\u63cf\u8ff0","type":"input","attrs":{"type":"text","placeholder":"\u7ec4\u4ef6\u63cf\u8ff0"},"value":"12312312"}}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/component/{id}
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {PUT} api/component/{id} api/component/{id}-PUT
     * @apiName PUT-api_component_{id}
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     * @apiParam {String} component_name 组件名称
     * @apiParam {String} component_desc 组件描述
     * @apiParam {String} attrs 属性数据类型
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[]}
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"component_attrs_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"ajax":true,"rownum":false,"hidden":[],"operation":true,"operations":{"addbind":{"color":"btn-success","text":"+"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d","\u5c5e\u6027\u503c","\u6570\u636e\u7c7b\u578b","\u6e32\u67d3\u7c7b\u578b"]},"data":{"total":"2","current_page":"1","last_page":"1","per_page":"10","list":[]}},"attrs_bind_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","ajax":false,"uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"rownum":true,"hidden":[],"advancedColumn":{"default_value":{"type":"input"}},"operation":true,"operations":{"attrunbind":{"color":"btn-warning","text":"R"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d","\u6570\u636e\u7c7b\u578b","\u6e32\u67d3\u7c7b\u578b"]},"data":{"total":"3","current_page":"1","last_page":"1","per_page":"10","list":[{"id":2,"attr_name":"adf","attr_type":"string","form_type":"input"},{"id":3,"attr_name":"asdfsad","attr_type":"string","form_type":"input"}]}},"component_form":{"attrs":{"caption":"\u7ec4\u4ef6","buttons":{"preinstall":{"submit":false,"cancel":"1"},"others":[{"name":"submit","class":"btn-info","event":"submit"}]},"action":{"uri":"\/api\/component\/8","method":"PUT","success":{"redirect":"\/components"}}},"fields":{"id":{"name":" ID","type":"input","hidden":true,"value":8},"component_name":{"name":"\u7ec4\u4ef6\u540d\u79f0","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u7ec4\u4ef6\u540d\u79f0"},"value":"123"},"component_desc":{"name":"\u7ec4\u4ef6\u63cf\u8ff0","type":"input","attrs":{"type":"text","placeholder":"\u7ec4\u4ef6\u63cf\u8ff0"},"value":"12312312"}}}}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/component/{id}
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
     *{"code":1,"msg":"OK","data":{"component_attrs_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"ajax":true,"rownum":false,"hidden":[],"operation":true,"operations":{"addbind":{"color":"btn-success","text":"+"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d","\u5c5e\u6027\u503c","\u6570\u636e\u7c7b\u578b","\u6e32\u67d3\u7c7b\u578b"]},"data":{"total":"2","current_page":"1","last_page":"1","per_page":"10","list":[]}},"attrs_bind_table":{"attrs":{"caption":"\u7ec4\u4ef6\u5c5e\u6027\u8868","ajax":false,"uris":{"query":{"url":"\/api\/attrs","param":[],"method":"GET"}},"rownum":true,"hidden":[],"advancedColumn":{"default_value":{"type":"input"}},"operation":true,"operations":{"attrunbind":{"color":"btn-warning","text":"R"}},"header":[{"name":"ID","width":"20px"},"\u5c5e\u6027\u540d","\u6570\u636e\u7c7b\u578b","\u6e32\u67d3\u7c7b\u578b"]},"data":{"total":"3","current_page":"1","last_page":"1","per_page":"10","list":[{"id":2,"attr_name":"adf","attr_type":"string","form_type":"input"},{"id":3,"attr_name":"asdfsad","attr_type":"string","form_type":"input"}]}},"component_form":{"attrs":{"caption":"\u7ec4\u4ef6","buttons":{"preinstall":{"submit":false,"cancel":"1"},"others":[{"name":"submit","class":"btn-info","event":"submit"}]},"action":{"uri":"\/api\/component\/8","method":"PUT","success":{"redirect":"\/components"}}},"fields":{"id":{"name":" ID","type":"input","hidden":true,"value":8},"component_name":{"name":"\u7ec4\u4ef6\u540d\u79f0","type":"input","attrs":{"type":"text","default":"asdda","placeholder":"\u7ec4\u4ef6\u540d\u79f0"},"value":"123"},"component_desc":{"name":"\u7ec4\u4ef6\u63cf\u8ff0","type":"input","attrs":{"type":"text","placeholder":"\u7ec4\u4ef6\u63cf\u8ff0"},"value":"12312312"}}}}}
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
     * @apiSuccess {String} attr_name 属性名称
     * @apiSuccess {String} attr_value 属性值
     * @apiSuccess {String} attr_type 属性数据类型
     * @apiSuccess {String} form_type 渲染类型
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":3,"current_page":1,"last_page":1,"per_page":15,"list":[{"id":8,"component_name":"123","component_desc":"12312312","attrs":[{"attr_id":"2","attr_name":"adf","attr_value":"afdfds","attr_type":"string","form_type":"input"},{"attr_id":"3","attr_name":"asdfsad","attr_value":"asdfasdf","attr_type":"string","form_type":"input"}]},{"id":9,"component_name":"3123","component_desc":"123123123","attrs":[{"attr_id":"2","attr_name":"adf","attr_value":"afdfds","attr_type":"string","form_type":"input"},{"attr_id":"1","attr_name":"123","attr_value":"123123","attr_type":"float","form_type":"checkbox"}]},{"id":11,"component_name":"123dfsa","component_desc":"123","attrs":[{"attr_id":"3","attr_name":"asdfsad","attr_value":"asdfasdf","attr_type":"string","form_type":"input"}]}]}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/external/components/list
     */