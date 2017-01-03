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
            
            var ddd = {
                'pageConfig' : Utils.apiReqData(d) ,
                'runtime' : {
                    'bindedAttr' : {},
                }
            };
            
            var binded = ddd.pageConfig.attrs_bind_table.data.list;
            for(var i in binded){
                ddd.runtime.bindedAttr[binded[i]['id']] = true;
            }
            
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
//                                if('' == tableData[i]['default_value']){
//                                    return $(this.$children[2].$el).find('tr[data-id='+tableData[i].id+']')
//                                    .find('input')
//                                    .focus();
//                                }else{
//                                    attrBindData.push({
//                                        'id' : tableData[i].id,
//                                        'default_value' : tableData[i].default_value
//                                    });
//                                }
                                attrBindData.push({
                                    'id' : tableData[i].id,
                                    'default_value' : ''
                                });
                            }
                            
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
                    'isAttrBinded' : function(attr_id){
                        return true === this.runtime.bindedAttr[attr_id];
                    },
                    'setAttrBinded' : function(attr_id){
                        this.runtime.bindedAttr[attr_id] = true;
                    }, 
                    'setAttrUnbinded' : function(attr_id){
                        this.runtime.bindedAttr[attr_id] = false;
                    }, 
                    'attrUnbind' : function(e){
                        var target = e.target;
                        var attr_id = target.getAttribute("data-id");
                        for(var i in this.pageConfig.attrs_bind_table.data.list){
                            if(this.pageConfig.attrs_bind_table.data.list[i].id == attr_id){
                                this.pageConfig.attrs_bind_table.data.list.splice(i,1);
                                break;
                            }
                        }
                        this.setAttrUnbinded(attr_id);
                    },
                    'tableaddbind' : function(e){
                        var target = e.target;
                        var attr_id = target.getAttribute("data-id");
                        var tr$1 = target.parentNode.parentNode.parentNode;
                        var attr_name = tr$1.getElementsByTagName('td')[1].innerHTML;
                        var attr_type = tr$1.getElementsByTagName('td')[3].innerHTML;
                        var form_type = tr$1.getElementsByTagName('td')[4].innerHTML;
                        if(this.isAttrBinded(attr_id)){
                            return false;
                        }
                        this.appendTableData('attrs_bind_table',{
                            "id": attr_id,
                            "attr_name": attr_name,
                            "attr_type": attr_type,
                            "form_type": form_type,
                        });
                        this.setAttrBinded(attr_id);
                    }
                }
            });
        }
    });
})
