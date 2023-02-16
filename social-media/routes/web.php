<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
    Route::get('/login',[AuthController::class,'login']);
    Route::post('/create/login',[AuthController::class,'save']);
    Route::get('/register',[AuthController::class,'index']);
    Route::post('/create/register',[AuthController::class,'create']);
});

// /* Admin */
Route::group(['prefix' => 'admin', 'middleware' => ['adminauth']], function(){
    Route::get('/dashboard',[AdminController::class,'view']);
});
Route::get('/login',[AdminController::class,'index']);
Route::post('/create/login',[AdminController::class,'login']);
Route::get('/logout',[AdminController::class,'logout']);

// /* User */
Route::prefix('user')->group(function () {
    Route::get('/profile',[UserController::class,'index']);
    Route::get('/post',[PostController::class,'index']);
    Route::post('/create/post',[PostController::class,'create']);
    Route::get('/list/post',[PostController::class,'list']);
    Route::get('/show/post',[PostController::class,'show']);
});