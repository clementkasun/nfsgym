<?php

use App\Http\Controllers\BasicSalaryController;
use App\Http\Controllers\LoanPerEmpController;
use App\Models\SecurityBasicSalary;
use App\Http\Controllers\SecurityBasicSallaryController;
use App\Models\LoanPerEmp;
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
    return view('/auth/login');
});

Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout']); # post
//Route::get('/emp_registration', function () {
//    return view('/employee/employee_registration');
//});
// Route::get('/instructor_registration', function () {
//     return view('/registration/instructor_registration');
// });
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/results/export', [JsonResultsController::class, 'index']);

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'load_dash_board'])->name('dashboard');
    Route::get('/emp_registration', [App\Http\Controllers\EmployeeRegistrationsController::class, 'index']);

    // auth
    Route::get('/rolls', [App\Http\Controllers\RollController::class, 'index'])->name('system_Rolls');
    Route::get('/roll_view', [App\Http\Controllers\RollController::class, 'index'])->name('system_Rolls');
    Route::get('/users_list', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/id/{id}', [App\Http\Controllers\UserController::class, 'edit']);

    //Route::get('/test', function () {
    //    return view('auth.testlogin');//});
    Route::post('/users', [App\Http\Controllers\UserController::class, 'create'])->name('system_Rolls');
    Route::post('/rolls', [App\Http\Controllers\RollController::class, 'create'])->name('create_system_Rolls');

    #put
    Route::put('/users/id/{id}', [App\Http\Controllers\UserController::class, 'store']);
    Route::put('/users/password/{id}', [App\Http\Controllers\UserController::class, 'storePassword']);

    #delete
    Route::delete('/users/id/{id}', [App\Http\Controllers\UserController::class, 'delete']);
    Route::get('/users/myProfile', [App\Http\Controllers\UserController::class, 'myProfile']);
    Route::put('/users/my_password', [App\Http\Controllers\UserController::class, 'changeMyPass']);

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'load_dash_board']);
    Route::get('/sms', [App\Http\Controllers\ShortMessageController::class, 'index']);
});
