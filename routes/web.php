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
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin/dashboard','middleware' => ['auth:admin']], function () {
    Route::get('/', 'Dashboard\DashboardController@index')->name('admin.dashboard');

    Route::get('/admins', 'Dashboard\AdminController@index')->name('admin.index');
    Route::post('/admins/add', 'Dashboard\AdminController@store')->name('admin.add');
    Route::get('/admins/edit/{id}', 'Dashboard\AdminController@edit')->name('admin.edit');
    Route::put('/admins/update/{id}', 'Dashboard\AdminController@update')->name('admin.update');
    Route::get('/admins/show/{id}', 'Dashboard\AdminController@show')->name('admin.show');
    Route::post('/admins/delete/{id}', 'Dashboard\AdminController@delete')->name('admin.delete');

    Route::get('/users', 'Dashboard\UserController@index')->name('user.index');
    Route::post('/users/add', 'Dashboard\UserController@store')->name('user.add');

    Route::get('/roles', 'Dashboard\RoleController@index')->name('role.index');
    Route::get('/roles/create', 'Dashboard\RoleController@create')->name('role.create');
    Route::get('/roles/show/{id}', 'Dashboard\RoleController@show')->name('role.show');
    Route::post('/roles/add', 'Dashboard\RoleController@store')->name('role.add');

});

Route::get('/test', function () {
   $test = DB::connection('mysql2')->select('select * from people where login = :phone',['phone' => '380985594949']);

   return json_encode($test, JSON_UNESCAPED_UNICODE);
});
