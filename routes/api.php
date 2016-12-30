<?php
use Illuminate\Http\Request;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



Route::get('/sidebar', [
    'as' => 'api_sidebar',
    'uses' => 'SystemArchitecture\ApiController@sidebarMenu'
]);

Route::get('/formConfig', [
    'as' => 'api_formConfig',
    'uses' => 'SystemArchitecture\ApiController@formConfig'
]);




Route::post('/attr', [
    'as' => 'api_attrs_create',
    'uses' => 'SystemArchitecture\ApiController@attrs_create'
]);
Route::get('/attrs', [
    'as' => 'api_attrs_list',
    'uses' => 'SystemArchitecture\ApiController@attrs_list'
]);

Route::get('/attr/{id}', [
    'as' => 'api_attrs_detail',
    'uses' => 'SystemArchitecture\ApiController@attrs_detail'
]);

Route::put('/attr/{id}', [
    'as' => 'api_attrs_update',
    'uses' => 'SystemArchitecture\ApiController@attrs_update'
]);
Route::delete('/attr/{id}', [
    'as' => 'api_attrs_delete',
    'uses' => 'SystemArchitecture\ApiController@attrs_delete'
]);



Route::post('/component', [
    'as' => 'api_component_create',
    'uses' => 'Component\ApiController@create'
]);
Route::get('/components', [
    'as' => 'api_components_query',
    'uses' => 'Component\ApiController@query'
]);
Route::get('/component/{id}', [
    'as' => 'api_component_detail',
    'uses' => 'Component\ApiController@detail'
]);
Route::put('/component', [
    'as' => 'api_component_update',
    'uses' => 'Component\ApiController@update'
]);
Route::delete('/component/{id}', [
    'as' => 'api_component_delete',
    'uses' => 'Component\ApiController@delete'
]);


