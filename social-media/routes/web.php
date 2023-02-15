<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

/* Admin Auth */
Route::get('/', function () { return view('auth.dashboard'); });
Route::prefix('auth')->group(function () {
    Route::get('/login',function(){ return view('auth.login');});
    Route::post('/create/login',[AuthController::class,'create']);
    Route::get('/register',[AuthController::class,'index']);
    Route::post('/create/register',[AuthController::class,'create']);
});

/* Admin */
Route::get('/admin/login',function(){ return view('admin.login');});
Route::get('/admin/dashboard',function(){ return view('admin.dashboard');});
Route::get('/admin/home',function(){ return view('admin.home'); });

/* User */
Route::prefix('user')->group(function () {
    Route::get('/profile',[UserController::class,'index']);
    Route::post('/create/profile',[UserController::class,'create']);
    Route::get('/show/profile',[UserController::class,'show']);
});