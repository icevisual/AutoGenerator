require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    
    var mtc = window.location.pathname.match(/\/(\d+)/);
    
    $.ajax({
        'url' : '/api/table/'+mtc[1]+'/deploy',
//        'url' : '/api/table/'+mtc[1],
        'method' : 'GET',
        'dataType' : 'json',
        'data' : {
        },
        'success' : function(d){
            
            if(!Utils.apiReqSuccess(d)){
                return alert(Utils.apiReqMsg(d));
            }
            
            var ddd = {
                'pageConfig' : Utils.apiReqData(d) ,
                'runtime' : {
                    'bindedAttr' : {},
                }
            };
            
            var vmForm = new EVue({
                'el' : '#formDemo',
                'data' : ddd,
                'methods' : {
                    'submitComponent' : function(formValidateRet,formData){
                        console.log('submitComponent',formValidateRet,formData);
                        if(false !== formValidateRet){
                            // check default Value
                            var tableData = this.getTableData('attrs_bind_table');
                            
                            var attrBindData = [];
                            
                            for(var i in tableData){
                                attrBindData.push({
                                    'id' : tableData[i].id,
                                    'default_value' : tableData[i].default_value
                                });
                            }
                            console.log('attrBindData',attrBindData);
                            if(Utils.isEmptyObj(attrBindData)){
                                return alert('请选择控件属性');
                            }
                            formValidateRet['attrs'] = attrBindData;
                            Utils.ajax({
                                'url' : vmForm.pageConfig.component_form.attrs.action.uri,
                                'method' : vmForm.pageConfig.component_form.attrs.action.method,
                                'data' : formValidateRet,
                                'success' : function(d){
                                    if(Utils.apiReqSuccess(d)){
                                        window.location.href = vmForm.pageConfig.component_form.attrs.action.success.redirect
                                    }else{
                                        alert(Utils.apiReqMsg(d));
                                    }
                                },
                                'error' : function(d){
                                    
                                }
                            });
                        }
                    },
                    'tablesubmit' : function(e){
                        console.log("tablesubmit");
                        
                        var thisTableKey = 'table';
                        var tableData = this.getTableData('table');
                        var validateData = [];
                        
                        for(var i in tableData){
                            validateData.push({
                                'column' : tableData[i].COLUMN_NAME,
                                'validate' : tableData[i].validate
                            });
                        }
                        console.log('validateData',validateData);
                        if(Utils.isEmptyObj(validateData)){
                            return;
                        }
                        
                        var reqCfg = vmForm.pageConfig[thisTableKey].attrs.uris.save;
                        
                        Utils.ajax({
                            'url' : reqCfg.url,
                            'method' : reqCfg.method,
                            'data' : {
                                'tablename' : vmForm.pageConfig[thisTableKey].attrs.tablename,
                                'validate' : validateData
                            },
                            'success' : function(d){
                                if(Utils.apiReqSuccess(d)){
//                                    window.location.href = reqCfg.success.redirect
                                }else{
                                    alert(Utils.apiReqMsg(d));
                                }
                            },
                            'error' : function(d){
                                
                            }
                        });
                    }
                }
            });
        }
    });
})
