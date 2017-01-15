require.config({
    baseUrl : '/js',
    paths : {
        'jQuery' : '../plugins/jQuery/jQuery-2.1.4.min', 
        'bootstrap' : '../bootstrap/js/bootstrap.min',
        'jQuery.slimscroll' : '../plugins/slimScroll/jquery.slimscroll.min',
        'fastclick' : '../plugins/fastclick/fastclick.min',
        'ALTApp' : '../dist/js/app.min',
        'demo' : '../dist/js/demo',
//        'Vue' : '../dist/js/vue.v2.1.6.min',
        'Vue' : '../dist/js/vue',
        'Components' : './Components',
        'Utils' : 'Utils',
    },
    shim : {
        'jQuery' : {
            exports : '$'
        },
        'Components' : {
            exports : 'Vue'
        },
        'jQuery.slimscroll' : ['jQuery'],
        'bootstrap' : ['jQuery'],
        'demo' : ['jQuery'],
        'ALTApp' : ['jQuery','jQuery.slimscroll','bootstrap','fastclick'],
    }
});
define(['Vue','jQuery','Components','ALTApp','demo','Utils'],function(Vue,$) {
    var vm = new Vue({
        'el' : '#sidebar-menu-vue',
        'mounted' : function() {
            $.ajax({
                'url' : '/api/sidebar',
                'dataType' : 'json',
                'data' : {
                    pathname : window.location.pathname
                },
                'success' : function(data) {
                    vm.sidebar = data.data;
                },
                'error' : function(data){
                    
                }
            });
        },
        'data' : {
            'sidebar' : {}
        }
    });
    
    
    var EVue = Vue.extend({
        'methods' : {
            'removeTableRow' : function(key,row){
                this.pageConfig[key].data.list.splice(row,1);
            },
            'isMarked' : function(runtimeKey,key){
                if(undefined === key){
                    return (undefined !== this.runtime[runtimeKey] && false !== this.runtime[runtimeKey]);
                }
                return (undefined !== this.runtime[runtimeKey][key] && false !== this.runtime[runtimeKey][key]);
            },
            'markWithKey' : function(runtimeKey,key,data){
                if(undefined === data){
                    this.runtime[runtimeKey][key] = true;
                }else{
                    this.runtime[runtimeKey][key] = data;
                }
            },
            'mark' : function(runtimeKey,data){
                if(undefined === data){
                    this.runtime[runtimeKey] = true;
                }else{
                    this.runtime[runtimeKey] = data;
                }
            },
            'getMarkedData' : function(runtimeKey,key){
                if(undefined === key){
                    return this.runtime[runtimeKey];
                }
                return this.runtime[runtimeKey][key];
            },
            'unmark' : function(runtimeKey,key){
                if(undefined === key){
                    return this.runtime[runtimeKey] = false;
                }
                this.runtime[runtimeKey][key] = false;
            }, 
            'formReset' : function(formTag){
                var fields = this.pageConfig[formTag].fields;
                for(var i in fields){
                    if(undefined !== fields[i]['default']){
                        fields[i].value = fields[i]['default'];
                    }else{
                        fields[i].value = '';
                    }
                }
            },
            'formFieldReset' : function(formTag,field,defaultValue){
                if(undefined === this.pageConfig[formTag].fields[field]){
                    return false;
                }
                var defaultVal = this.pageConfig[formTag].fields[field]['default'];
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
            },
            'appendTableData' : function(tableTag,data){
                this.pageConfig[tableTag].data.list.push(data);
            },
            'getTableData' : function(tableTag,row){
                if(undefined === row){
                    return this.pageConfig[tableTag].data.list;
                }
                return this.pageConfig[tableTag].data.list[row];
            },
            'updateTableRow' : function(tableTag,row,data){
                for(var i in data){
                    this.pageConfig[tableTag].data.list[row][i] = data[i];
                }
            }
        }
    });
    return EVue;
});
