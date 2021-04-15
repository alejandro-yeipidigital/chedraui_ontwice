<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

/***************************
 *          Public
 ***************************/

Route::get('/', 'HomeController@index')
    ->name('home');

Route::get('/terminos-y-condiciones', function() {
        return view('public.terms');
    })->name('terms');

Route::get('/aviso-de-privacidad', function() {
        return view('public.privacy');
    })->name('privacy');



//COMPLETE REGISTER
Route::get('/completa-tu-registro', 'UserController@edit' )
    ->name('users.edit');
Route::post('/completa-tu-registro', 'UserController@update')
    ->name('users.update');


//PROFILE
Route::get('/perfil', 'UserController@profile')
    ->name('users.profile');


//RANKING
Route::get('/ranking/{temporality?}', 'HomeController@ranking' )
    ->name('ranking');


// GAME
Route::get('jugar/instrucciones', 'GameController@instructions')->name('game.instructions');
Route::get('jugar', "GameController@game")->name('game.play');
Route::get('jugar/demo', function() {
    return view('public.game.index');
});
Route::post('/juego/save-points', "GameController@savePoints")->name('game.save-points');

Route::group(['prefix' => 'tickets'], function() {
    Route::get('/', 'ParticipationController@index')->name('tickets.index');
    Route::post('/upload', 'ParticipationController@upload')->name('tickets.upload');
});


// ======== ROUTES USER FACEBOOK ========
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

/***************************
 *          Admin
 ***************************/
Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login');
Route::post('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
