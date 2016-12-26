var vmForm ;
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
            };
            
            vmForm = new EVue({
                'el' : '#formDemo',
                'data' : ddd,
                'methods' : {
                    'bindNewAttr' : function(attr){
                        console.log('bindNewAttr',arguments);
                        if(false != attr){
                            
                            this.formFieldReset('attr_bind_form','attr_id');
                            this.formFieldReset('attr_bind_form','default_value');
                            
                            vmForm.pageConfig.component_attrs_table.list.push({
                                'attr_name_cn' : attr.attr_id,
                                'attr_name_en' : attr.attr_id,
                                'attr_type' : attr.attr_id,
                                'default_value' : attr.default_value
                            });
                        }
                    },
                    'submitComponent' : function(attr){
                        console.log('submitComponent',attr);
                    },
                    'addNewAttr' : function(attr){
                        console.log('addNewAttr',attr);
                        if(false != attr){

                            this.formFieldReset('attr_form','attr_name_cn');
                            this.formFieldReset('attr_form','attr_name_en');
                            
                            this.appendFormSelect('attr_bind_form','attr_id',{
                                'value' : attr.attr_name_cn,
                                'text' : attr.attr_name_cn + '(' + attr.attr_type + ')',
                            });
                        }
                    },
                    'NewAttrBtn' : function(){
                        console.log('NewAttrBtn',arguments);
                        vmForm.runtime.showAttrForm = true;
                    },
                    'cancelAddNewAttr' : function(){
                        
                        this.formFieldReset('attr_form','attr_name_cn');
                        this.formFieldReset('attr_form','attr_name_en');
                        
                        vmForm.runtime.showAttrForm = false;
                    },
                    
                    'formFieldReset' : function(formTag,field,defaultValue){
                        var defaultVal = this.pageConfig[formTag].fields[field].default;
                        defaultVal = undefined === defaultValue ? defaultVal : defaultValue;
                        if(undefined === defaultVal){
                            this.pageConfig[formTag].fields[field].value = '';
                        }else{
                            this.pageConfig[formTag].fields[field].value = defaultVal;
                        }
                    },
                    'formSelectInit' : function(formTag,field,data){
                        this.pageConfig[formTag].fields[field].data = data;
                    },
                    'appendFormSelect' : function(formTag,field,data){
                        if(data instanceof Array ){
                            for(var i in data){
                                this.pageConfig[formTag].fields[field].data.push(data[i]); 
                            }
                        }else{
                            this.pageConfig[formTag].fields[field].data.push(data);
                        }
                    }
                    
                }
            });
        }
    });
})
