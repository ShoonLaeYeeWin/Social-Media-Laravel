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

/* Auth */
Route::get('/', function () { return view('auth.dashboard'); });
Route::prefix('auth')->group(function () {
    Route::get('/login',[AuthController::class,'login']);
    Route::post('/create/login',[AuthController::class,'save']);
    Route::get('/register',[AuthController::class,'index']);
    Route::post('/create/register',[AuthController::class,'create']);
    Route::get('/logout',[AuthController::class,'logout']);
});

// /* User */
Route::group(['prefix' => 'user', 'middleware' => ['userauth']], function(){
    Route::get('/profile',[UserController::class,'index']);
    Route::get('/post',[PostController::class,'index']);
    Route::post('/create/post',[PostController::class,'create']);
    Route::get('/list/post',[PostController::class,'list']);
    Route::get('/delete/post/{id}',[PostController::class,'delete']);
    Route::get('/edit/post/{id}',[PostController::class,'edit']);
    Route::post('/update/post/{id}',[PostController::class,'update']);
});

// /* Admin */
Route::group(['prefix' => 'admin', 'middleware' => ['adminauth']], function(){
    Route::get('/dashboard',[AdminController::class,'view']);
    Route::get('/profile',[AdminController::class,'show']);
    Route::get('/edit/profile',[AdminController::class,'edit']);
});
Route::get('/delete/profile/{id}',[AdminController::class,'upgrade']);
/* Admin auth */
Route::get('/login',[AdminController::class,'index']);
Route::post('/create/login',[AdminController::class,'login']);
Route::get('/logout',[AdminController::class,'logout']);
