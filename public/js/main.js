require.config({
    baseUrl : '/js',
    paths : {
        'app' : 'app/' + window.location.pathname.substr(1).replace('/','-'),
    },
});
require(['initialize','app'], function() {
    
})
