require.config({
    paths : {
        'jQuery' : '../plugins/jQuery/jQuery-2.1.4.min', 
        'bootstrap' : '../bootstrap/js/bootstrap.min',
        'jQuery.slimscroll' : '../plugins/slimScroll/jquery.slimscroll.min',
        'fastclick' : '../plugins/fastclick/fastclick.min',
        'app' : '../dist/js/app.min',
        'demo' : '../dist/js/demo',
        'Vue' : '../dist/js/vue.min',
        'Utils' : 'Utils',
    },
    shim : {
        'jQuery' : {
            exports : '$'
        },
        'jQuery.slimscroll' : ['jQuery'],
        'bootstrap' : ['jQuery'],
        'demo' : ['jQuery'],
        'app' : ['jQuery','jQuery.slimscroll'],
    }
});
var vm ;
require([ 'jQuery','Vue','Utils','bootstrap','jQuery.slimscroll','fastclick','app','demo' ], function($) {
    var Vue = require('Vue'),Utils = require('Utils');
    var sidebarConfig = [];
    vm = new Vue({
        'el' : '#sidebar-menu-vue',
        'mounted' : function() {
            Utils.ajax({
                'url' : '/api/sidebar',
                'dataType' : 'json',
                'success' : function(data) {
                    console.log(data);
                    vm.sidebar = data.data;
//                    vm.$set('sidebar',data.data)
                },
                'error' : function(data){
                    
                }
            });
        },
        'data' : {
            'sidebar' : sidebarConfig
        }
    });
    
})
