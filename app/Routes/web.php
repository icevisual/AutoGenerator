<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',function(){
    return redirect(route('components_query'));
});

Route::get('/404','Web\SystemController@error_404');
    
    
Route::get('/demo', [
    'as' => 'demo_list',
    'uses' => 'Web\SystemController@demo_list'
]);

Route::get('/demo/create', [
    'as' => 'demo_create',
    'uses' => 'Web\SystemController@demo_create'
]);

// 筛选所有 需要在左侧显示的
// 指向统一页面
// 顺序

Route::group([
    'sideBar' => '1',
    'group' => [
        'title' => 'MAIN NAVIGATION'
    ],
], function(){
    Route::group([
        'menus' => [
            'icon' => 'fa-dashboard',
            'title' => 'System',
        ],
    ], function(){
        Route::get('/tables', [
            'as' => 'query_tables',
            'uses' => 'Web\TableController@query',
            
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'QUERY TABLES'
            ]
        ]);
        Route::get('/table/{id?}', [
            'as' => 'table_create',
            'uses' => 'Web\TableController@create',
            
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'TABLE CREATE'
            ]
        ]);
        Route::get('/table/{id}/deploy', [
            'as' => 'table_deploy',
            'uses' => 'Web\TableController@deploy',
            
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'TABLE CREATE'
            ]
        ]);
    });

    Route::group([
        'menus' => [
            'icon' => 'fa-files-o',
            'title' => 'Layout Options',
        ],
    ], function(){

        Route::get('/attrs', [
            'as' => 'attrs_list',
            'uses' => 'Web\ComponentAttrsController@query',
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'ATTRS LIST'
            ],
        ]);
        
        Route::get('/attr', [
            'as' => 'attrs_create',
            'uses' => 'Web\ComponentAttrsController@create',
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'ATTRS CREATE'
            ],
        ]);
        
        Route::get('/attr/{id}', [
            'as' => 'attrs_update',
            'uses' => 'Web\ComponentAttrsController@create',
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'ATTRS CREATE'
            ],
        ]);
        
        Route::get('/components', [
            'as' => 'components_query',
            'uses' => 'Web\ComponentController@query',
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'COMPONENTS LIST'
            ],
            
        ]);
        
        Route::get('/component/{id?}', [
            'as' => 'component_create',
            'uses' => 'Web\ComponentController@create',
            'submenus' => [
                'icon' => 'fa-circle-o',
                'title' => 'COMPONENTS CREATE'
            ],
        ]);
    });
});

 
