

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
     * @apiSuccess {String} componentName 控件名称
     * @apiSuccess {String} componentDesc 控件描述
     * @apiSuccess {Integer} attrId 属性ID
     * @apiSuccess {String} attrName 属性名称
     * @apiSuccess {String} defaultValue 属性值
     * @apiSuccess {String} attrType 属性数据类型
     * @apiSuccess {String} formType 渲染类型
     *
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/external/components/list
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {POST} api/external/form/save 保存表单控件
     * @apiName POST-api_external_form_save
     * @apiGroup Open_Web
     *
     * @apiParam {String} name unknown
     * @apiParam {String} components {"components":[{"id":"12","attrs":[{"attrId":"132","defaultValue":"ad"},{"attrId":"123","defaultValue":""}]}]}
     *
     *
     *
     *
     * @apiErrorExample Error-Responsee: 
     *{"code":9003,"msg":"\u8868\u5355\u540d\u5b57 \u5df2\u7ecf\u5b58\u5728\u3002","data":[]}
     *
     * @apiSampleRequest http://automation.local.com//api/external/form/save
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/external/form/query 表单列表
     * @apiName GET-api_external_form_query
     * @apiGroup Open_Web
     *
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":[{"id":1,"name":"ddddd"},{"id":2,"name":"666"}]}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/external/form/query
     */

    /**
     * @apiVersion 1.0.0
     *
     * @api {GET} api/external/form/detail 表单详情
     * @apiName GET-api_external_form_detail
     * @apiGroup Open_Web
     *
     * @apiParam {String} id id
     *
     *
     * @apiSuccessExample Success-Response: HTTP/1.1 200 OK
     *{"code":1,"msg":"OK","data":{"form":{"id":2,"name":"666","createdAt":"2017-01-05 07:04:21","updatedAt":"2017-01-05 07:04:21"},"components":[{"id":12,"componentName":"text","componentDesc":"text\u6587\u672c\u6846,password\uff08\u5bc6\u7801\u6846\uff09,time\uff08\u65f6\u95f4\u9009\u62e9\u5668\uff09,number\uff08\u6570\u503c\u6846\uff09,email\uff08\u90ae\u7bb1\uff09,phone number\uff08\u7535\u8bdd\u53f7\u7801\uff09,file(\u4e0a\u4f20\u6587\u4ef6)","attrs":{"charLength":{"attrId":"8","attrName":"charLength","attrNameCn":"\u5b57\u7b26\u957f\u5ea6","defaultValue":"","attrType":"integer","formType":"input"},"width":{"attrId":"10","attrName":"width","attrNameCn":"\u5bbd\u5ea6","defaultValue":"200","attrType":"integer","formType":"input"},"name":{"attrId":"6","attrName":"name","attrNameCn":"\u540d\u79f0","defaultValue":"111","attrType":"string","formType":"input"},"height":{"attrId":"15","attrName":"height","attrNameCn":"\u9ad8\u5ea6","defaultValue":"36","attrType":"integer","formType":"input"},"type":{"attrId":"7","attrName":"type","attrNameCn":"\u7c7b\u578b","defaultValue":"text,password,time,number,email,phone number,file","attrType":"array","formType":"select"},"require":{"attrId":"9","attrName":"require","attrNameCn":"\u662f\u5426\u5fc5\u586b","defaultValue":"","attrType":"boolean","formType":"checkbox"}}}]}}
     *
     *
     *
     * @apiSampleRequest http://automation.local.com//api/external/form/detail
     */