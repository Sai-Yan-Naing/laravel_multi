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

// Route::view('/', 'adminLoginForm');
// Route::view('/home', 'welcome');
Route::get('/', function () {
    return redirect()->route('adminLoginForm');
});
Auth::routes();
Route::get('/home', function () {
    return redirect()->route('adminLoginForm');
});
Auth::routes();
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('adminLoginForm');
Route::get('/login/employee', 'Auth\LoginController@showEmployeeLoginForm')->name('employeeLoginForm');
// Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
// Route::get('/register/employee', 'Auth\RegisterController@showEmployeeRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('adminLogin');
Route::post('/login/employee', 'Auth\LoginController@employeeLogin')->name('employeeLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('createAdmin');
Route::post('/register/employee', 'Auth\RegisterController@createEmployee')->name('createEmployee');


Route::get('logout', function () {
    Session()->flush();
    auth()->logout();
    return Redirect::to('/login/admin');
})->name('logout');

Route::group(['middleware' => 'auth:admin'],function () {
    // Auth::routes();
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/company', 'CompanyController@listCompany')->name('listCompany');
    Route::get('/company/create', 'CompanyController@createCompany')->name('createCompany');
    Route::get('/company/{id}/edit', 'CompanyController@editCompany')->name('editCompany');
    Route::post('/company/store', 'CompanyController@storeCompany')->name('storeCompany');
    Route::put('/company/{id}/update', 'CompanyController@updateCompany')->name('updateCompany');
    Route::delete('/company/{id}/delete', 'CompanyController@deleteCompany')->name('destoryCompany');

    Route::get('/employee', 'EmployeeController@listEmployee')->name('listEmployee');
    Route::get('/employee/create', 'EmployeeController@createEmployee')->name('createEmployee');
    Route::get('/employee/{id}/edit', 'EmployeeController@editEmployee')->name('editEmployee');
    Route::post('/employee/store', 'EmployeeController@storeEmployee')->name('storeEmployee');
    Route::put('/employee/{id}/update', 'EmployeeController@updateEmployee')->name('updateEmployee');
    Route::delete('/employee/{id}/delete', 'EmployeeController@deleteEmployee')->name('destoryEmployee');

    Route::get('/dashboard/export', 'AdminController@export')->name('export');
    });

    Route::group(['middleware' => 'auth:employee'], function () {
        // Auth::routes();
        Route::get('/employee/dashboard', 'AdminController@employeeDashboard')->name('employeeDashboard');
        Route::get('/company-list', 'CompanyController@eListCompany')->name('eListCompany');
        Route::get('/employee-list', 'EmployeeController@eListEmployee')->name('eListEmployee');
    });
