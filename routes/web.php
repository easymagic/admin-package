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


Auth::routes();

Route::get('/', function () {
//    return view('welcome');
    return redirect()->route('login');
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home',function(){
    return redirect()->route('dashboard');
})->name('home')->middleware(['auth']);

Route::resource('user',\App\Http\Controllers\UserController::class)->middleware(['auth']);

Route::get('dashboard',[\App\Http\Controllers\UserController::class,'dashboard'])->name('dashboard')->middleware(['auth']);

Route::resource('company',\App\Http\Controllers\CompanyController::class)->middleware(['auth']);
