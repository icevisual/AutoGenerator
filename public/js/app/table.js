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
                    'runtime' : {
                        'fields' : {},
                    }
                },
                'created' : function(){
                    var fieldList = this.getTableData('table');
                    for(var i = 0 ; i < fieldList.length ; i ++ ){
                        this.runtime.fields[fieldList[i].COLUMN_NAME] = true;
                    }
                },
                'methods' : {
                    'RemoveField' : function(e){
                        var row = e.target.getAttribute('data-row');
                        var key = $(e.target).parents('tr').find('td').eq(1).html();
                        console.log('key = ' + key,this.runtime['fields'][key]);
                        this.unmark('fields',key);
                        this.removeTableRow('table',row);
                    },
                    'UpdateField' : function(){
                        
                    },
                    'AddColumn' : function(formValidateRet,formEl){
                        var columnTypeValidate = {
                            "bigint": "NUMERIC_PRECISION",
                            "int": "NUMERIC_PRECISION",
                            "mediumint": "NUMERIC_PRECISION",
                            "smallint": "NUMERIC_PRECISION",
                            "tinyint": "NUMERIC_PRECISION",
                            "decimal": "NUMERIC_PRECISION,NUMERIC_SCALE",
                            "char": "CHARACTER_MAXIMUM_LENGTH",
                            "varchar": "CHARACTER_MAXIMUM_LENGTH"
                        };
                        if(false !== formValidateRet){
                            var requiredColumns = columnTypeValidate[formValidateRet['DATA_TYPE']];
                            // 不同类型字段的长度、精度验证
                            if(requiredColumns ){
                                var columnsArray = requiredColumns.split(',');
                                var numericRegex = /^[1-9]\d*$/;
                                for(var i in columnsArray){
                                    var key = columnsArray[i];
                                    if(undefined !== formValidateRet[key]){
                                        if(!numericRegex.test(formValidateRet[key])){
                                            var _form = $(formEl);
                                            var _valField = _form.find('[name='+key+']');
                                            return _valField.focus();
                                        }
                                    }
                                }
                            }
                            if(this.isMarked('fields',formValidateRet['COLUMN_NAME'])){
                                console.log('Has Already Marked');
                                return false;
                            }
                            console.log('formValidateRet',formValidateRet);
                            this.appendTableData('table',{
                                "COLUMN_NAME": formValidateRet['COLUMN_NAME'],
                                "COLUMN_NAME_CN": formValidateRet['COLUMN_NAME_CN'],
                                "DATA_TYPE": formValidateRet['DATA_TYPE'],
                                "IS_NULLABLE": formValidateRet['IS_NULLABLE'],
                                "COLUMN_DEFAULT": formValidateRet['COLUMN_DEFAULT'],
                            });
                            // set key added
                            this.mark('fields',formValidateRet['COLUMN_NAME'],formValidateRet);
                            // Clear form
                            this.formReset('column_form');
                        }
                    }
                }
            });
        }
    });
})
