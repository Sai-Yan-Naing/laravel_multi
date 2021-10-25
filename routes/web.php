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

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/employee', 'Auth\LoginController@showEmployeeLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/employee', 'Auth\RegisterController@showEmployeeRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('adminLogin');
Route::post('/login/employee', 'Auth\LoginController@employeeLogin')->name('employeeLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('createAdmin');
Route::post('/register/employee', 'Auth\RegisterController@createEmployee')->name('createEmployee');

Route::group(['middleware' => 'auth:employee'], function () {
    Auth::routes();
    Route::view('/employee', 'employee');
});
// Route::group(['middleware' => 'auth:admin'], function () {
//     Auth::routes();
//     Route::view('/admin', 'admin');
// });

Route::group(['middleware' => 'auth:admin'],function () {
    Auth::routes();
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/company', 'AdminController@listCompany')->name('listCompany');
    Route::get('/company/create', 'AdminController@createCompany')->name('createCompany');
    Route::get('/company/{id}/edit', 'AdminController@editCompany')->name('editCompany');
    Route::post('/company/store', 'AdminController@storeCompany')->name('storeCompany');
    Route::put('/company/{id}/update', 'AdminController@updateCompany')->name('updateCompany');
    Route::delete('/company/{id}/delete', 'AdminController@deleteCompany')->name('destoryCompany');

    Route::get('/employee', 'EmployeeController@listEmployee')->name('listEmployee');
    Route::get('/employee/create', 'EmployeeController@createEmployee')->name('createEmployee');
    Route::get('/employee/{id}/edit', 'EmployeeController@editEmployee')->name('editEmployee');
    Route::post('/employee/store', 'EmployeeController@storeEmployee')->name('storeEmployee');
    Route::put('/employee/{id}/update', 'EmployeeController@updateEmployee')->name('updateEmployee');
    Route::delete('/employee/{id}/delete', 'EmployeeController@deleteEmployee')->name('destoryEmployee');

    Route::get('/dashboard/export', 'AdminController@export')->name('export');
    });
