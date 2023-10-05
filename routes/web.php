<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('index');

    //Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostsController::class, 'index']) ->name('index');
        Route::get('/add', [PostsController::class, 'add'])->name('add')   ;
    });
    //Groups
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('/', [GroupsController::class, 'index'])->name('index');
        Route::get('/add', [GroupsController::class, 'add'])->name('add');
    });
    //Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index']) ->name('index');
        Route::get('/add', [UsersController::class, 'add'])->name('add')   ;
    });
});
