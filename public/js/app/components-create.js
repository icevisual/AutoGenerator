

var vmForm ;
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
            
//            d.data.attr_bind_form.fields.attr_id.data = {};
//            for(var i in d.data.attrs_list){
//                
//            }
//            d.data.attrs_list
            
            
            vmForm = new Vue({
                'el' : '#formDemo',
                'data' : d.data,
                'methods' : {
                    'bindNewAttr' : function(attr){
                        console.log('bindNewAttr',arguments);
                        if(false != attr){
                            
                            vmForm.attr_bind_form.fields.attr_id.value = vmForm.attr_bind_form.fields.attr_id.default;
                            vmForm.attr_bind_form.fields.default_value.value = '';
                            
                            vmForm.component_attrs_table.list.push({
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
                            
                            vmForm.attr_form.fields.attr_name_cn.value = '';
                            vmForm.attr_form.fields.attr_name_en.value = '';
                            
                            vmForm.attr_bind_form.fields.attr_id.data.push({
                                'value' : attr.attr_name_cn,
                                'text' : attr.attr_name_cn + '(' + attr.attr_type + ')',
                            });
                        }
                    }
                }
            });
        }
    });
})
