<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::group(['prefix' => 'auth', 'namespace' => 'UserAuthApi'], function () {
//    Route::post('signin', 'SignInController');
//    Route::post('signout', 'SignOutController');
//    Route::get('me', 'MeController');
//});


Route::get('/dbs', 'Helix\HelixController@getDbs');
Route::post('/getColumns', 'Helix\HelixController@tableColumnslist');
Route::post('/search', 'Helix\HelixController@getSearch');
