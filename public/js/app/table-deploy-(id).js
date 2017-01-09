require(['initialize'], function(EVue) {
    var $ = require('jQuery'),
        Vue = require('Vue'),
        Utils = require('Utils');
    
    var mtc = window.location.pathname.match(/\/(\d+)/);
    
    $.ajax({
        'url' : '/api/table/deploy/' + mtc[1],
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
                    'tableaddbind' : function(e){
                        var target = e.target;
                        var attr_id = target.getAttribute("data-id");
                        var tr$1 = target.parentNode.parentNode.parentNode;
                        var attr_name = tr$1.getElementsByTagName('td')[1].innerHTML;
                        var attr_name_cn = tr$1.getElementsByTagName('td')[2].innerHTML;
                        var attr_type = tr$1.getElementsByTagName('td')[3].innerHTML;
                        var form_type = tr$1.getElementsByTagName('td')[4].innerHTML;
                        
                        if(this.isAttrBinded(attr_id)){
                            return false;
                        }
                        this.appendTableData('attrs_bind_table',{
                            "id": attr_id,
                            "attr_name": attr_name,
                            "attr_name_cn": attr_name_cn,
                            "attr_type": attr_type,
                            "form_type": form_type,
                            "default_value": '',
                        });
                        this.setAttrBinded(attr_id);
                    }
                }
            });
        }
    });
})
