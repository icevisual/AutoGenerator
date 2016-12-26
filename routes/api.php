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

Route::post('/attrs', [
    'as' => 'api_attrs_create',
    'uses' => 'SystemArchitecture\ApiController@attrs_create'
]);
Route::get('/attrs', [
    'as' => 'api_attrs_list',
    'uses' => 'SystemArchitecture\ApiController@attrs_list'
]);

Route::get('/attrs/{id}', [
    'as' => 'api_attrs_detail',
    'uses' => 'SystemArchitecture\ApiController@attrs_detail'
]);

Route::put('/attrs/{id}', [
    'as' => 'api_attrs_update',
    'uses' => 'SystemArchitecture\ApiController@attrs_update'
]);
Route::delete('/attrs/{id}', [
    'as' => 'api_attrs_delete',
    'uses' => 'SystemArchitecture\ApiController@attrs_delete'
]);
