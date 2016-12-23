require(['initialize'], function() {
    var $ = require('jQuery'),
        Vue = require('Vue');
    $.ajax({
        'url' : '/api/formConfig',
        'dataType' : 'json',
        'data' : {
            pathname : window.location.pathname
        },
        'success' : function(d){
            var vmForm = new Vue({
                'el' : '#formDemo',
                'data' : d.data,
                'methods' : {
                    'btnclickHd' : function(){
                        console.log('btnclickHd',arguments);
                    },
                    'btnclickHd1' : function(){
                        console.log('btnclickHd1',arguments);
                    },
                    'btnclickHd2' : function(){
                        console.log('btnclickHd2',arguments);
                    }
                }
            });
        }
    });
})
