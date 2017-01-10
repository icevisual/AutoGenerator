require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    
    $.ajax({
        'url' : '/api/formConfig',
        'dataType' : 'json',
        'data' : {
            pathname : window.location.pathname
        },
        'success' : function(d){
            if(!Utils.apiReqSuccess(d)){
                return alert(Utils.apiReqMsg(d));
            }
            var vmForm = new EVue({
                'el' : '#formDemo',
                'data' : {
                    'pageConfig' : Utils.apiReqData(d) ,
                }
            });
        }
    });
})
