require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    
    var mtc = window.location.pathname.match(/\/(\d+)/);
    
    $.ajax({
        'url' : '/api/attr/' + mtc[1],
        'dataType' : 'json',
        'success' : function(d){
            if(!Utils.apiReqSuccess(d)){
                return alert(Utils.apiReqMsg(d));
            }
            var vmForm = new EVue({
                'el' : '#formDemo',
                'data' : {
                    'pageConfig' : Utils.apiReqData(d) ,
                },
                'methods' : {
                    'addNewAttr' : function(formValidateRet,formData){
                        console.log('addNewAttr',formValidateRet,formData);
                        if(false != formValidateRet){
                            Utils.ajax({
                                'url' : formData.formConfig.attrs.action.uri,
                                'method' : formData.formConfig.attrs.action.method,
                                'data' : formValidateRet,
                                'success' : function(d){
                                    if(Utils.apiReqSuccess(d)){
                                        window.location.href = formData.formConfig.attrs.action.success.redirect
                                    }else{
                                        alert(Utils.apiReqMsg(d));
                                    }
                                },
                                'error' : function(d){
                                    
                                }
                            });
                        }
                    }
                }
            });
        }
    });
})
