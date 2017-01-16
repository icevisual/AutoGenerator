require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    var mtc = window.location.pathname.match(/\/(\d+)/);
    
    $.ajax({
        'url' :  '/api/table/' + mtc[1],
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
                        'isUpdating' : false
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
                        this.unmark('fields',key);
                        this.removeTableRow('table',row);
                    },
                    'UpdateField' : function(e){
                        var row = e.target.getAttribute('data-row');
                        var key = $(e.target).parents('tr').find('td').eq(1).html();
                        var formData = this.getTableData('table',row);
                        for(var i in formData){
                            this.formFieldReset('column_form',i,formData[i]);
                        }
                        // mark that it is updating
                        this.mark('isUpdating',row);
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
                                var numericRegex = /^0|([1-9]\d*)$/;
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
                            
                            if('NO' === formValidateRet['IS_NULLABLE']){
                                if(!formValidateRet['COLUMN_DEFAULT'] && 1 === parseInt(formValidateRet['IS_INPUT'])){
                                    alert('当字段必填时，需有默认值或者为接口输入');
                                    return ;
                                }
                            }
                            
                            var isUpdatingKey = 'isUpdating',// 是否在更新
                                fieldsTableKey = 'table', // 字段表KEY
                                fieldsMapKey = 'fields', // 已加字段MAP KEY
                                columnFormKey = 'column_form'; // 新增字段表单 KEY
                            if(this.isMarked('isUpdating')){
                                var updatingRow = this.getMarkedData(isUpdatingKey)
                                var sourceData = this.getTableData(fieldsTableKey,updatingRow);
                                var columnName = formValidateRet['COLUMN_NAME'];
                                if(columnName != sourceData['COLUMN_NAME']){
                                    // 改列名则验证是否重名
                                    if(this.isMarked(fieldsMapKey,columnName)){
                                        alert('已存在同名字段，请更改字段名');
                                        return false;
                                    }
                                    // 注销原列名的已占用标识
                                    this.unmark(fieldsMapKey,sourceData['COLUMN_NAME']);
                                }
                                // 更新数据
                                this.markWithKey(fieldsMapKey,formValidateRet['COLUMN_NAME']);
                                // 更新显示的列表数据
                                this.updateTableRow(fieldsTableKey,this.getMarkedData(isUpdatingKey),formValidateRet);
                                // 清空表单
                                this.formReset(columnFormKey);
                                // 取消更新标识
                                this.unmark(isUpdatingKey);
                            }else{
                                if(this.isMarked(fieldsMapKey,formValidateRet['COLUMN_NAME'])){
                                    alert('已存在同名字段，请更改字段名');
                                    return false;
                                }
                                console.log('formValidateRet',formValidateRet);
                                this.appendTableData(fieldsTableKey,{
                                    "COLUMN_NAME": formValidateRet['COLUMN_NAME'],
                                    "COLUMN_NAME_CN": formValidateRet['COLUMN_NAME_CN'],
                                    "DATA_TYPE": formValidateRet['DATA_TYPE'],
                                    "IS_NULLABLE": formValidateRet['IS_NULLABLE'],
                                    "COLUMN_DEFAULT": formValidateRet['COLUMN_DEFAULT'],
                                    "CHARACTER_MAXIMUM_LENGTH": formValidateRet['CHARACTER_MAXIMUM_LENGTH'],
                                    "NUMERIC_PRECISION": formValidateRet['NUMERIC_PRECISION'],
                                    "NUMERIC_SCALE": formValidateRet['NUMERIC_SCALE'],
                                    "COLUMN_COMMENT": formValidateRet['COLUMN_COMMENT'],
                                });
                                // 标为已存在
                                this.markWithKey(fieldsMapKey,formValidateRet['COLUMN_NAME']);
                                // 清空表单
                                this.formReset(columnFormKey);
                            }
                        }
                    },
                    'submitTable' : function(formValidateRet,formEl){
                        if(false !== formValidateRet){
                            var fieldData = this.getTableData('table');
                            if(fieldData.length <= 0){
                                return alert('请加入字段');
                            }
                            var this$1 = this;
                            $.ajax({
                                'url' : this.pageConfig.table_form.attrs.action.uri,
                                'method' : this.pageConfig.table_form.attrs.action.method,
                                'data' : {
                                    'table_name' : formValidateRet['TABLE_NAME'],
                                    'table_comment' : formValidateRet['TABLE_COMMENT'],
                                    'columns' : fieldData
                                },
                                'dataType' : 'json',
                                'success' : function(d){
                                    if(Utils.apiReqSuccess(d)){
                                        alert("OK");
//                                        window.location.href = this$1.pageConfig.table_form.attrs.action.success.redirect
                                    }else{
                                        alert(Utils.apiReqMsg(d));
                                    }
                                },
                                'error' : function(d){
                                    console.log(d);
                                }
                            });
                            
                        }
                    }
                }
            });
        }
    });
})
