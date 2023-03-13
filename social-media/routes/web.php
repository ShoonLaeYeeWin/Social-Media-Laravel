<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;

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
    Route::controller(UserAuthController::class)->group(function () {
        Route::middleware('user.redirect')->get('/register', 'index')->name('user.showRegister');
        Route::post('/create/register', 'create')->name('user.actionRegister');
        Route::middleware('user.redirect')->get('/login', 'login')->name('user.showLogin');
        Route::post('/actionLogin', 'save')->name('user.actionLogin');
        Route::get('/logout', 'logout')->name('user.logout');
    });
    Route::controller(AdminAuthController::class)->group(function () {
        Route::middleware('auth.redirect')->get('/admin/login', 'index')->name('admin.showLogin');
        Route::post('/admin/actionLogin', 'login')->name('admin.actionLogin');
        Route::get('/admin/logout', 'logout')->name('admin.logout');
    });
});

/* User */
Route::prefix('user')->middleware('userauth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('user.dashboard');
        Route::get('/profile', 'index')->name('user.profile');
        Route::get('/edit/profile/{id}', 'edit')->name('user.profileEdit');
        Route::post('/update/profile/{id}', 'update')->name('user.profileUpdate');
        Route::post('/create/dashboard/post', 'createPost')->name('dashboard.createPost');
    });
    Route::controller(PostController::class)->group(function () {
        Route::get('/post', 'index')->name('post.showPost');
        Route::post('/create/post', 'create')->name('post.createPost');
        Route::get('/list/post', 'list')->name('post.listPost');
        Route::get('/delete/post/{id}', 'delete')->name('post.deletePost');
        Route::get('/edit/post/{id}', 'edit')->name('post.editPost');
        Route::post('/update/post/{id}', 'update')->name('post.updatePost');
        Route::get('/status_update/{id}', 'statusUpdate')->name('status.update');
        Route::get('/postList/export/{id}', 'exportCsv')->name('post.export');
        Route::post('/postList/import/{id}', 'importCsv')->name('post.import');
    });
    Route::controller(CommentController::class)->group(function () {
        Route::get('/posts/{post}', 'show')->name('comment.showComment');
        Route::post('/create/comment/{id}', 'create')->name('comment.createComment');
    });
});

/* Admin */
Route::prefix('admin')->controller(AdminController::class)->middleware('adminauth')->group(function () {
    Route::get('/dashboard', 'view')->name('admin.dashboard');
    Route::get('/profile', 'show')->name('admin.profile');
    Route::get('/edit/profile/{id}', 'edit')->name('admin.profileEdit');
    Route::post('/update/profile/{id}', 'upgrade')->name('admin.profileUpdate');
    Route::get('/list/user', 'listUser')->name('admin.userlist');
    Route::get('/status_update/{id}', 'statusUpdate')->name('admin.status');
    Route::get('/delete/user/{id}', 'deleteUser')->name('admin.userDelete');
    Route::get('/userList/export', 'exportCsv')->name('admin.export');
});
