require.config({
    baseUrl : '/js',
    paths : {
//        'initialize' : 'initialize',
        'app' : 'app/' + window.location.pathname.substr(1).replace('/','-'),
    },
});
require(['initialize','app'], function() {
    
})
