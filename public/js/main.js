require.config({
    paths : {
        'initialize' : 'initialize',
    },
});
require(['initialize' ], function() {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    var formTableConfig = {
        'formConfig' : {
            'accessKey' : {
                'name' : '开发者 AccessKey',
                'validate' : {
                    'rules' : 'required|max:20',
                    'message' : {
                        'require' : '请填写 开发者 AccessKey'
                    },
                },
                'type' : 'input',
                'attrs' : {
                    'type' : 'text',
                    'default' : 'asdda',
                    'placeholder' : '开发者 AccessKey',
                },
                'value' : '',
            },
            'accessSecret' : {
                'name' : '开发者 AccessSecret',
                'validate' : {
                    'rules' : 'required|max:20',
                    'message' : {
                        'require' : '请填写 开发者 AccessSecret'
                    },
                },
                'type' : 'input',
                'attrs' : {
                    'type' : 'text',
                    'placeholder' : '开发者 AccessSecret',
                },
                'value' : '',
            },
            'logLevel' : {
                'name' : '日志级别',
                'type' : 'select',
                'value' : 'debug',
                'attrs' : {
                    'multiple' : 'multiple',
                },
                'data' : [
                   {
                       'value' : 'debug',
                       'text' : 'debug',
                   },
                   {
                       'value' : 'info',
                       'text' : 'info',
                   },
                   {
                       'value' : 'notice',
                       'text' : 'notice',
                   },
                   {
                       'value' : 'warning',
                       'text' : 'warning',
                   },
                   {
                       'value' : 'error',
                       'text' : 'error',
                   }
                ],
            },
            'env' : {
                'name' : '环境',
                'type' : 'select',
                'value' : 'local',
                'data' : [
                    {
                        'value' : 'local',
                        'text' : '本地(192.168.5.61:8083)',
                    },      
                    {
                        'value' : 'test',
                        'text' : '测试(121.41.33.141:8083)',
                    },
                    {
                        'value' : 'production',
                        'text' : '正式(120.26.109.169:8083)',
                    }
                ]
            },
        }
    };
    $.ajax({
        'url' : '/api/formConfig',
        'dataType' : 'json',
        'success' : function(d){
            var vmForm = new Vue({
                'el' : '#formDemo',
                'data' : d.data,
//                'data' : formTableConfig,
                'methods' : {
                    'btnclickHd' : function(){
                        console.log(arguments);
                    }
                }
            });
        }
    });
})
