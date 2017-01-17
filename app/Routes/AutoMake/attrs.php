<?php


Route::get('/attrs', [
    'as' => 'api_auto_attrs_query',
    'uses' => 'AutoMake\AttrsController@query'
]);
Route::post('/attrs', [
    'as' => 'api_auto_attrs_create',
    'uses' => 'AutoMake\AttrsController@create'
]);
Route::get('/attrs/{id}', [
    'as' => 'api_auto_attrs_detail',
    'uses' => 'AutoMake\AttrsController@detail'
]);
Route::put('/attrs/{id}', [
    'as' => 'api_auto_attrs_update',
    'uses' => 'AutoMake\AttrsController@update'
]);
Route::delete('/attrs/{id}', [
    'as' => 'api_auto_attrs_delete',
    'uses' => 'AutoMake\AttrsController@delete'
]);