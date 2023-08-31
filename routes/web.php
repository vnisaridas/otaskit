<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/admin','middleware' => ['web', 'auth']], function () {
	Route::resource('employee', App\Http\Controllers\EmployeeController::class);
	Route::resource('task', App\Http\Controllers\TaskController::class);

	/*Route::get('dailylog', [
        'as' => 'admin.dailylog',
        'uses' => 'App\Http\Controllers\TaskController@log',
    ]);*/
});

Route::get('/TaskCreate',function(){
	return view('email.taskcreated');
});