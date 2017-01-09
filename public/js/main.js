require.config({
    baseUrl : '/js',
    paths : {
//        'app' : 'app/' + window.location.pathname.substr(1).replace(/\d+/,'(id)').replace('/','-'),
        'app' : 'app/' + window.location.pathname.substr(1).split(/\d+/).join('(id)').split('/').join('-')
    },
});
require(['initialize'], function() {
    var reqApp = require.config({
        baseUrl : '/js',
        paths : {
            'app' : 'app/' + window.location.pathname.substr(1).split(/\d+/).join('(id)').split('/').join('-')
        },
    });
    reqApp(['app'],function(){
        
    });
    
})
