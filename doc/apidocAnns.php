

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
     * @apiParam {String} attr_name_cn 显示中文名
     * @apiParam {String} attr_value 属性值
     * @apiParam {String} attr_type 属性数据类型
     * @apiParam {String} form_type unknown
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
     * @api {GET} api/attrs api/attrs-GET
     * @apiName GET-api_attrs
     * @apiGroup Open_Web
     *
     * @apiParam {String} [p=1] 页数
     * @apiParam {String} [n=10000] 每页条数
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"total":11,"current_page":1,"last_page":1,"per_page":10000,"list":[{"id":6,"attr_name":"name","attr_name_cn":"\u540d\u79f0","attr_value":"","attr_type":"string","form_type":"input"},{"id":7,"attr_name":"type","attr_name_cn":"\u7c7b\u578b","attr_value":"text\u6587\u672c\u6846,password\uff08\u5bc6\u7801\u6846\uff09,time\uff08\u65f6\u95f4\u9009\u62e9\u5668\uff09,number\uff08\u6570\u503c\u6846\uff09,email\uff08\u90ae\u7bb1\uff09,phone number\uff08\u7535\u8bdd\u53f7\u7801\uff09,file(","attr_type":"array","form_type":"select"},{"id":8,"attr_name":"charLength","attr_name_cn":"\u5b57\u7b26\u957f\u5ea6","attr_value":"","attr_type":"integer","form_type":"input"},{"id":9,"attr_name":"require","attr_name_cn":"\u662f\u5426\u5fc5\u586b","attr_value":"","attr_type":"boolean","form_type":"checkbox"},{"id":10,"attr_name":"width","attr_name_cn":"\u5bbd\u5ea6","attr_value":"200","attr_type":"integer","form_type":"input"},{"id":12,"attr_name":"width","attr_name_cn":"\u5bbd\u5ea6","attr_value":"400","attr_type":"integer","form_type":"input"},{"id":13,"attr_name":"width","attr_name_cn":"\u5bbd\u5ea6","attr_value":"13","attr_type":"integer","form_type":"input"},{"id":14,"attr_name":"width","attr_name_cn":"\u5bbd\u5ea6","attr_value":"62","attr_type":"integer","form_type":"input"},{"id":15,"attr_name":"height","attr_name_cn":"\u9ad8\u5ea6","attr_value":"36","attr_type":"integer","form_type":"input"},{"id":16,"attr_name":"height","attr_name_cn":"\u9ad8\u5ea6","attr_value":"300","attr_type":"integer","form_type":"input"},{"id":17,"attr_name":"height","attr_name_cn":"\u9ad8\u5ea6","attr_value":"13","attr_type":"integer","form_type":"input"}]}}
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
     * @apiParam {String} attr_name_cn 显示中文名
     * @apiParam {String} attr_value 属性值
     * @apiParam {String} attr_type 属性数据类型
     * @apiParam {String} form_type unknown
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
     * @api {DELETE} api/attr/{id} api/attr/{id}-DELETE
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
     * @api {POST} api/component api/component-POST
     * @apiName POST-api_component
     * @apiGroup Open_Web
     *
     * @apiParam {String} component_name 控件名称
     * @apiParam {String} component_desc 控件描述
     * @apiParam {String} attrs 属性数据类型
     *
     *
     *
     *
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
     * @apiSuccess {String} attr_name 属性名称
     * @apiSuccess {String} attr_value 属性值
     * @apiSuccess {String} attr_type 属性数据类型
     * @apiSuccess {String} form_type 渲染类型
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[{"id":12,"componentName":"text","componentDesc":"text\u6587\u672c\u6846,password\uff08\u5bc6\u7801\u6846\uff09,time\uff08\u65f6\u95f4\u9009\u62e9\u5668\uff09,number\uff08\u6570\u503c\u6846\uff09,email\uff08\u90ae\u7bb1\uff09,phone number\uff08\u7535\u8bdd\u53f7\u7801\uff09,file(\u4e0a\u4f20\u6587\u4ef6)","attrs":{"require":{"attrId":"9","attrName":"require","attrNameCn":"\u662f\u5426\u5fc5\u586b","attrValue":"","attrType":"boolean","formType":"checkbox"},"charLength":{"attrId":"8","attrName":"charLength","attrNameCn":"\u5b57\u7b26\u957f\u5ea6","attrValue":"","attrType":"integer","formType":"input"},"width":{"attrId":"10","attrName":"width","attrNameCn":"\u5bbd\u5ea6","attrValue":"200","attrType":"integer","formType":"input"},"type":{"attrId":"7","attrName":"type","attrNameCn":"\u7c7b\u578b","attrValue":"text\u6587\u672c\u6846,password\uff08\u5bc6\u7801\u6846\uff09,time\uff08\u65f6\u95f4\u9009\u62e9\u5668\uff09,number\uff08\u6570\u503c\u6846\uff09,email\uff08\u90ae\u7bb1\uff09,phone number\uff08\u7535\u8bdd\u53f7\u7801\uff09,file(","attrType":"array","formType":"select"},"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}},{"id":13,"componentName":"button","componentDesc":"\u6309\u94ae","attrs":{"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}},{"id":14,"componentName":"checkbox","componentDesc":"\u590d\u9009\u6846","attrs":{"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}},{"id":15,"componentName":"radio","componentDesc":"\u5355\u9009\u6846","attrs":{"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}},{"id":16,"componentName":"select","componentDesc":"\u4e0b\u62c9\u6846","attrs":{"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}},{"id":17,"componentName":"textarea","componentDesc":"\u591a\u884c\u6587\u672c\u6846","attrs":{"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}},{"id":18,"componentName":"hidden","componentDesc":"\u9690\u85cf\u57df","attrs":{"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","attrValue":"","attrType":"string","formType":"input"}}}]}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/external/components/list
     */