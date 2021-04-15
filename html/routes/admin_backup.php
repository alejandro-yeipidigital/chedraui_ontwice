<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::catch(function() {
   throw new NotFoundHttpException('Página no encontrada');
});


Route::get('/', 'HomeController@index')->name('admin.home');


Route::resource('temporalities', 'TemporalityController');
Route::get('temporalities/{temporality}/changeStatus', 'TemporalityController@changeStatus')->name("temporalities.changeStatus");

// Query Manager
Route::get('querys', 'QueryController@query_manager_index')->name('querys.index');
Route::get('get_columns/{table}', 'QueryController@get_columns');
Route::post('execute_query', 'QueryController@get_visual_query');
Route::post('execute_manual_query', 'QueryController@get_manual_query');
Route::post('store_query', 'QueryController@storeQuery');
Route::post('export-query-xlsx', 'QueryController@exportQueryResultXlsx');
Route::post('export-query-csv', 'QueryController@exportQueryResultCsv');

Route::resource('admin/limit-tickets', 'AdmintlimiicketsController');
Route::resource('winners', 'AdminwinnersController');
Route::get('winners/{winner}/changeStatus', 'AdminwinnersController@changeStatus')->name('winners.changeStatus');

/**
 * Tickets
 */
Route::get('/tickets/all', 'TicketsController@index')->name('tickets.main');
Route::get('/tickets/{id}/pendientes', 'TicketsController@index')->name('tickets.pendientes');
Route::get('/tickets/{id}/validados', 'TicketsController@index')->name('tickets.validados');
Route::get('/tickets/{id}/rechazados', 'TicketsController@index')->name('tickets.rechazados');

Route::get('/tickets/{participation}/set-approved', 'TicketsController@setApproved')->name('tickets.set-approved');
Route::get('/tickets/{participation}/set-rejected', 'TicketsController@setRejected')->name('tickets.set-rejected');

Route::get('/tickets/{user}/user', 'TicketsController@user')->name('tickets.user');

/***
 * URL
 */
Route::get('/url', 'UrlController@index')->name('url.index');
Route::patch('/url/{url}/update', 'UrlController@update')->name('url.update');

