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



Route::get('/components/list', [
    'as' => 'outer_api_components_list',
    'uses' => 'ExternalApi\ComponentController@components_list'
]);

Route::post('/form/save', [
    'as' => 'outer_api_save_form_component',
    'uses' => 'ExternalApi\ComponentController@save_form'
]);

