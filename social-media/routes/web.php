<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

/* Auth */
Route::get('/', function () {
    return view('auth.dashboard');
});
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/create/login', [AuthController::class, 'save']);
    Route::get('/register', [AuthController::class, 'index']);
    Route::post('/create/register', [AuthController::class, 'create']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
// /* User */
Route::group(['prefix' => 'user', 'middleware' => ['userauth']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/profile', [UserController::class, 'index']);
    Route::get('/edit/profile/{id}', [UserController::class, 'edit']);
    Route::post('/update/profile/{id}', [UserController::class, 'update']);
    Route::get('/post', [PostController::class, 'index']);
    Route::post('/create/post', [PostController::class, 'create']);
    Route::get('/list/post', [PostController::class, 'list'])->name('list.post');
    Route::get('/delete/post/{id}', [PostController::class, 'delete']);
    Route::get('/edit/post/{id}', [PostController::class, 'edit']);
    Route::post('/update/post/{id}', [PostController::class, 'update']);
    Route::get('/show/comment', [CommentController::class, 'show'])->name('comment.show');
    Route::post('/create/comment', [CommentController::class, 'create']);
    Route::get('/postList/export', [PostController::class, 'exportCsv'])->name('post.export');
    Route::post('/postList/import', [PostController::class, 'importCsv'])->name('post.import');
});
// /* Admin */
Route::group(['prefix' => 'admin', 'middleware' => ['adminauth']], function () {
    Route::get('/dashboard', [AdminController::class, 'view'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'show']);
    Route::get('/edit/profile/{id}', [AdminController::class, 'edit']);
    Route::post('/update/profile/{id}', [AdminController::class, 'upgrade']);
    Route::get('/list/user', [AdminController::class, 'listUser'])->name('list.user');
    Route::get('/delete/user/{id}', [AdminController::class, 'deleteUser']);
    Route::get('/userList/export', [AdminController::class, 'exportCsv'])->name('user.export');
});
/* Admin auth */
Route::get('/login', [AdminController::class, 'index']);
Route::post('/create/login', [AdminController::class, 'login']);
Route::get('/logout', [AdminController::class, 'logout']);
