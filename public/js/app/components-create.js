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
                    'bindNewAttr' : function(attr){
                        console.log('bindNewAttr',arguments);
                        if(false != attr){
                            
                        }
                    },
                    'submitComponent' : function(attr){
                        console.log('submitComponent',attr);
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
                        
                        if(this.isAttrBinded(attr_id)){
                            return false;
                        }
                        
                        this.appendTableData('attrs_bind_table',{
                            "id": attr_id,
                            "attr_name_cn": attr_name,
                            "attr_type": attr_type,
                            "default_value": ""
                        });
                        this.setAttrBinded(attr_id);
                    }
                }
            });
        }
    });
})
