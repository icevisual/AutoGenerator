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
if(!\App::environment('testing')){
    $header['Access-Control-Allow-Origin'] = '*';
    $header['Access-Control-Allow-Methods'] = 'GET, PUT, POST, DELETE, HEAD, OPTIONS';
    $header['Access-Control-Allow-Headers'] = 'X-Requested-With, Origin, X-Csrftoken, Content-Type, Accept';
    
    foreach ($header as $head => $value) {
        header("{$head}: {$value}");
    }
}


Route::get('/components/list', [
    'as' => 'outer_api_components_list',
    'uses' => 'ExternalApi\ComponentController@components_list'
]);

Route::post('/form/save', [
    'as' => 'outer_api_save_form_component',
    'uses' => 'ExternalApi\ComponentController@save_form'
]);

Route::get('/form/query', [
    'as' => 'outer_api_query_forms',
    'uses' => 'ExternalApi\ComponentController@query_forms'
]);

Route::get('/form/detail', [
    'as' => 'outer_api_forms_detail',
    'uses' => 'ExternalApi\ComponentController@forms_detail'
]);











