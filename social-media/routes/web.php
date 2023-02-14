<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

/* Auth */
Route::get('/', function () { return view('auth.dashboard'); });
Route::get('/login',function(){ return view('auth.login');});
Route::get('/register',function(){ return view('auth.register');});
Route::post('/post/register',[AuthController::class,'index'])->name('register');

/* Admin */
Route::get('/admin/login',function(){ return view('admin.login');});
Route::get('/admin/dashboard',function(){ return view('admin.dashboard');});
Route::get('/admin/home',function(){ return view('admin.home'); });