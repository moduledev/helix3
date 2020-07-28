<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'auth', 'namespace' => 'UserAuthApi'], function () {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('me', 'MeController');
});


Route::middleware('web')->group(function () {
    Route::get('/dbs', 'User\HelixController@getDbs');
});
