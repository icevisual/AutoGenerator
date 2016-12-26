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

Route::get('/demo', [
    'as' => 'demo_list',
    'uses' => 'SystemArchitecture\WebController@demo_list'
]);

Route::get('/demo/create', [
    'as' => 'demo_create',
    'uses' => 'SystemArchitecture\WebController@demo_create'
]);

Route::get('/components', [
    'as' => 'components_list',
    'uses' => 'SystemArchitecture\WebController@components_list'
]);

Route::get('/components/create', [
    'as' => 'components_create',
    'uses' => 'SystemArchitecture\WebController@components_create'
]);




Route::get('/attrs', [
    'as' => 'attrs_list',
    'uses' => 'SystemArchitecture\WebController@attrs_list'
]);

Route::get('/attrs/create', [
    'as' => 'attrs_create',
    'uses' => 'SystemArchitecture\WebController@attrs_create'
]);

Route::get('/attrs/create/{id}', [
    'as' => 'attrs_update',
    'uses' => 'SystemArchitecture\WebController@attrs_create'
]);





