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
    'uses' => 'Api\SystemController@sidebarMenu'
]);

Route::get('/formConfig', [
    'as' => 'api_formConfig',
    'uses' => 'Api\SystemController@formConfig'
]);




Route::post('/attr', [
    'as' => 'api_attrs_create',
    'uses' => 'Api\ComponentAttrsController@create'
]);
Route::get('/attrs', [
    'as' => 'api_attrs_list',
    'uses' => 'Api\ComponentAttrsController@query'
]);

Route::get('/attr/{id}', [
    'as' => 'api_attrs_detail',
    'uses' => 'Api\ComponentAttrsController@detail'
]);

Route::put('/attr/{id}', [
    'as' => 'api_attrs_update',
    'uses' => 'Api\ComponentAttrsController@update'
]);
Route::delete('/attr/{id}', [
    'as' => 'api_attrs_delete',
    'uses' => 'Api\ComponentAttrsController@delete'
]);



Route::post('/component', [
    'as' => 'api_component_create',
    'uses' => 'Api\ComponentController@create'
]);
Route::get('/components', [
    'as' => 'api_components_query',
    'uses' => 'Api\ComponentController@query'
]);
Route::get('/component/{id}', [
    'as' => 'api_component_detail',
    'uses' => 'Api\ComponentController@detail'
]);
Route::put('/component/{id}', [
    'as' => 'api_component_update',
    'uses' => 'Api\ComponentController@update'
]);
Route::delete('/component/{id}', [
    'as' => 'api_component_delete',
    'uses' => 'Api\ComponentController@delete'
]);


Route::get('/tables', [
    'as' => 'api_tables_query',
    'uses' => 'Api\InformationSchemaController@queryTables'
]);



