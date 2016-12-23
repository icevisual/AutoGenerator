require.config({
    paths : {
        'jQuery' : '../plugins/jQuery/jQuery-2.1.4.min', 
        'bootstrap' : '../bootstrap/js/bootstrap.min',
        'jQuery.slimscroll' : '../plugins/slimScroll/jquery.slimscroll.min',
        'fastclick' : '../plugins/fastclick/fastclick.min',
        'app' : '../dist/js/app.min',
        'demo' : '../dist/js/demo',
        'Vue' : '../dist/js/vue.v2.1.6.min',
        'Components' : 'Components/HorizontalForm',
        'Components' : 'Components',
        'Utils' : 'Utils',
//        'domReady' : '../dist/js/domReady',
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
        'app' : ['jQuery','jQuery.slimscroll','bootstrap','fastclick'],
    }
});
define(['Vue','jQuery','Components','Utils','app'],function(Vue,$) {
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
});
