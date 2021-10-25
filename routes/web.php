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

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/employee', 'Auth\LoginController@employeeLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/employee', 'Auth\RegisterController@createEmployee');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');
Route::view('/employee', 'employee');
