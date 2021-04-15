<?php

// Authentication
Route::name('admin.')->group( function() {
    Route::get('/home','HomeController@index')->name('home');
    

	Route::namespace('Auth')->group( function() {
		//Login Routes
    	Route::get('/acceso','LoginController@showLoginForm')->name('login');
    	Route::post('/login','LoginController@login')->name('login');
    	Route::post('/logout','LoginController@logout')->name('logout');
	
    	//Forgot Password Routes
    	Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
    	Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	
    	//Reset Password Routes
    	Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
    	Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
	});
});

// Promotions
Route::prefix('promociones')
    ->name('admin.promociones.')
    ->group(function () {
        Route::get('/', 'PromotionController@index');
        Route::get('/{promotion}', 'PromotionController@show')->name('promocion');
        Route::post('/bloquear', 'PromotionController@blockPromotion')->name('block');
        Route::post('/switch-account', 'PromotionController@switchAccountStatus')->name('switch');
        Route::get('/metricas/{promotion}', 'PromotionController@editMetrics')->name('metrics');
        Route::post('/actualizar-metricas', 'PromotionController@updateTicketValidationMetrics')->name('update-metrics');
        Route::post('/descargar-ranking', 'PromotionController@downloadTemporalityRanking')->name('download-ranking');
        Route::get('/ranking/{temporality}', 'PromotionController@displayTemporalityRanking')->name('display-ranking');
    });

// Query Manager
Route::get('/querys', 'QueryController@query_manager_index');
Route::get('/get_columns/{table}', 'QueryController@get_columns');
Route::post('/execute_query', 'QueryController@get_visual_query');
Route::post('/execute_manual_query', 'QueryController@get_manual_query');
Route::post('/store_query', 'QueryController@storeQuery');
Route::post('/export-query-xlsx', 'QueryController@exportQueryResultXlsx');
Route::post('/export-query-csv', 'QueryController@exportQueryResultCsv');

// Users
Route::prefix('usuarios')
        ->name('admin.users.')
        ->group( function() {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/{user}', 'UserController@show')->name('show');
            Route::post('/bloquear', 'UserController@blockUser')->name('block');
            Route::post('/add-observations', 'UserController@addObservations')->name('observations');
            Route::post('/delete', 'UserController@delete')->name('delete');
            Route::post('/{user}', 'UserController@update')->name('update');
            
            // Conversations
            Route::get('/conversacion/{user}', 'UserController@showUserConversation')->name('conversation');
            Route::get('/get-conversation/{user}', 'UserController@getUserConversation');
        });

// Tickets
Route::prefix('tickets')
        ->name('admin.tickets.')
        ->group(function() {
            Route::get('/pendientes', 'TicketController@indexPendientes');
            Route::get('/', 'TicketController@index')->name('index');
            Route::get('/download', 'TicketController@downloadIndex');
            Route::post('/download', 'TicketController@exportValidTickets')->name('export');
            Route::get('/{ticket}', 'TicketController@show')->name('show');
            Route::post('/{ticket}', 'TicketController@update')->name('update');
        });

//Logs
Route::group(['prefix' => 'logs'], function() {
    Route::get('/', 'LogController@index');
    Route::post('/verify', 'LogController@verifyIncidence')->name('admin.verify_incidence');
});

// Download Logs
Route::get('/logs-download', 'LogDownloadController@index');

//Report
Route::prefix('reportes')
        ->name('admin.report')
        ->group(function(){
            Route::get('/', 'ReportController@index')->name('index'); 

        });