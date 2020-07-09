<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin/dashboard','middleware' => ['auth:admin']], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/admins', 'Admin\AdminController@index')->name('admin.index');
});

