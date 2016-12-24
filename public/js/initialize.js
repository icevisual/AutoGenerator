require.config({
    baseUrl : '/js',
    paths : {
        'jQuery' : '../plugins/jQuery/jQuery-2.1.4.min', 
        'bootstrap' : '../bootstrap/js/bootstrap.min',
        'jQuery.slimscroll' : '../plugins/slimScroll/jquery.slimscroll.min',
        'fastclick' : '../plugins/fastclick/fastclick.min',
        'ALTApp' : '../dist/js/app.min',
        'demo' : '../dist/js/demo',
        'Vue' : '../dist/js/vue.v2.1.6.min',
        'Components' : './Components',
//        'Utils' : 'Utils',
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
define(['Vue','jQuery','Components','ALTApp'],function(Vue,$) {
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
    
    
    var MyVue = Vue.extend({
        'methods' : {
            'formFieldReset' : function(formTag,field,defaultValue){
                var defaultVal = this.pageConfig[formTag].fields[field].default;
                defaultVal = undefined === defaultValue ? defaultVal : defaultValue;
                if(undefined === defaultVal){
                    this.pageConfig[formTag].fields[field].value = '';
                }else{
                    this.pageConfig[formTag].fields[field].value = defaultVal;
                }
            },
            'appendFormSelect' : function(formTag,field,data){
                this.pageConfig[formTag].fields[field].data.push(data);
            }
        }
    });
    return MyVue;
});
