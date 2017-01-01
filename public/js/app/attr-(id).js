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
                }
            });
        }
    });
})
