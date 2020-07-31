<?php

use Illuminate\Support\Facades\DB;
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
//Auth::routes(['register' => false]);
//Route::get('/home', 'HomeController@index')->name('home');

    Route::get('login', 'Admin\Auth\LoginController@showloginForm')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin/dashboard','middleware' => ['auth:admin']], function () {
    Route::get('/', 'Admin\Dashboard\DashboardController@index')->name('admin.dashboard');

    Route::get('/admins', 'Admin\Dashboard\AdminController@index')->name('admin.index');
    Route::post('/admins/add', 'Admin\Dashboard\AdminController@store')->name('admin.add');
    Route::get('/admins/edit/{id}', 'Admin\Dashboard\AdminController@edit')->name('admin.edit');
    Route::put('/admins/update/{id}', 'Admin\Dashboard\AdminController@update')->name('admin.update');
    Route::get('/admins/show/{id}', 'Admin\Dashboard\AdminController@show')->name('admin.show');
    Route::post('/admins/delete/{id}', 'Admin\Dashboard\AdminController@delete')->name('admin.delete');

    Route::get('/users', 'Admin\Dashboard\UserController@index')->name('user.index');
    Route::post('/users/add', 'Admin\Dashboard\UserController@store')->name('user.add');

    Route::get('/roles', 'Admin\Dashboard\RoleController@index')->name('role.index');
    Route::get('/roles/create', 'Admin\Dashboard\RoleController@create')->name('role.create');
    Route::get('/roles/show/{id}', 'Admin\Dashboard\RoleController@show')->name('role.show');
    Route::post('/roles/add', 'Admin\Dashboard\RoleController@store')->name('role.add');

    Route::get('/dbs', 'Helix\HelixController@dbStatus')->name('helix.index');

});

Route::group(['prefix' => 'user/auth'], function () {
    Route::get('login', 'UserAuthWeb\LoginController@login');
    Route::post('login', 'UserAuthWeb\LoginController@loginUser')->name('user.login');
    Route::post('logout', 'UserAuthWeb\LoginController@logout')->name('user.logout');
});

Route::group(['prefix' => 'user/dashboard','middleware' => ['auth:user']], function () {
    Route::get('/', 'User\DashboardController@index')->name('user.dashboard');
    Route::get('/search', 'User\DashboardController@search')->name('user.search');

});

Route::get('/test1', 'Helix\HelixController@tableColunmslist');
