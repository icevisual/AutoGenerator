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


Route::get('/demo', [
    'as' => 'demo_list',
    'uses' => 'Web\SystemArchitectureController@demo_list'
]);

Route::get('/demo/create', [
    'as' => 'demo_create',
    'uses' => 'Web\SystemArchitectureController@demo_create'
]);




Route::get('/components', [
    'as' => 'components_query',
    'uses' => 'Web\ComponentController@query'
]);

Route::get('/component/{id?}', [
    'as' => 'component_create',
    'uses' => 'Web\ComponentController@create'
]);




Route::get('/attrs', [
    'as' => 'attrs_list',
    'uses' => 'Web\ComponentAttrsController@query'
]);

Route::get('/attr', [
    'as' => 'attrs_create',
    'uses' => 'Web\ComponentAttrsController@create'
]);

Route::get('/attr/{id}', [
    'as' => 'attrs_update',
    'uses' => 'Web\ComponentAttrsController@create'
]);





