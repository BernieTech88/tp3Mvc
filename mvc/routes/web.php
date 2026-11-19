<?php

use App\Routes\Route;
use App\Controllers\HomeController;

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('/clients', 'ClientController@index');

Route::get('/client/show', 'ClientController@show');

Route::get('/client/create', 'ClientController@create');
Route::post('/client/create', 'ClientController@store');

Route::get('/client/edit', 'ClientController@edit');
Route::post('/client/edit', 'ClientController@update');

Route::post('/client/delete', 'ClientController@delete');

/*********************************/
Route::get('/voitures', 'VoitureController@index');

Route::get('/voiture/show', 'VoitureController@show');

Route::get('/voiture/create', 'VoitureController@create');
Route::post('/voiture/create', 'VoitureController@store');

Route::get('/voiture/edit', 'VoitureController@edit');
Route::post('/voiture/edit', 'VoitureController@update');

Route::post('/voiture/delete', 'VoitureController@delete');




/*******************************/


Route::get(
    '/reservations',
    'ReservationController@index'
);

Route::get(
    '/reservation/show',
    'ReservationController@show'
);

Route::get(
    '/reservation/create',
    'ReservationController@create'
);

Route::post(
    '/reservation/create',
    'ReservationController@store'
);

Route::get(
    '/reservation/edit',
    'ReservationController@edit'
);

Route::post(
    '/reservation/edit',
    'ReservationController@update'
);

Route::post(
    '/reservation/delete',
    'ReservationController@delete'
);

/*********************************/
/* Authentification */
/*********************************/

Route::get(
    '/login',
    'AuthController@create'
);

Route::post(
    '/login',
    'AuthController@store'
);

Route::get(
    '/logout',
    'AuthController@delete'
);


Route::get(
    '/logs',
    'LogController@index'
);

/** pour le pdf */
Route::get(
'/reservation/pdf/{id}',
'ReservationController@pdf'
);

/****************Route d incription**/
Route::get(
    '/register',
    'RegisterController@create'
);

Route::post(
    '/register',
    'RegisterController@store'
);
/********catalog**/
Route::get(
    '/catalogue',
    'VoitureController@catalogue'
);

Route::get(
    '/mes-reservations',
    'ReservationController@mesReservations'
);


Route::dispatch();